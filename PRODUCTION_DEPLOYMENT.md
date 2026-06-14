# PANDUAN PRODUCTION DEPLOYMENT

## Prequisite

- PHP 8.2+
- MySQL 5.7+
- Composer installed
- SSH access ke server

---

## 1. QUICK DEPLOYMENT SCRIPT

Jika Anda memiliki shell access, jalankan script ini:

```bash
#!/bin/bash

# Set variables
APP_PATH="/var/www/visitor-kai"
APP_USER="www-data"
APP_GROUP="www-data"

echo "========================================="
echo "Visitor KAI Production Deployment"
echo "========================================="

# Step 1: Pull code
echo "[1/7] Updating application code..."
cd $APP_PATH
git pull origin main

# Step 2: Install dependencies
echo "[2/7] Installing composer dependencies..."
composer install --optimize-autoloader --no-dev

# Step 3: Set permissions
echo "[3/7] Setting permissions..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chown -R $APP_USER:$APP_GROUP storage/
chown -R $APP_USER:$APP_GROUP bootstrap/cache/

# Step 4: Environment setup
echo "[4/7] Running migrations..."
php artisan migrate --force

# Step 5: Clear cache
echo "[5/7] Clearing cache..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Step 6: Cache optimization
echo "[6/7] Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer dump-autoload --optimize

# Step 7: Done
echo "[7/7] Deployment complete!"
echo "========================================="
echo "✅ Application is ready to serve!"
```

---

## 2. MANUAL DEPLOYMENT STEPS

### A. Clone/Update Code

```bash
cd /var/www/
git clone https://github.com/your-repo/visitor-kai.git
cd visitor-kai

# OR untuk update existing:
cd /var/www/visitor-kai
git pull origin main
```

### B. Install Dependencies

```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node dependencies (jika ada)
npm install --production
```

### C. Setup Environment

```bash
# Copy .env template
cp .env.example .env

# Edit file .env
nano .env

# Generate APP_KEY (pastikan belum ada)
php artisan key:generate
```

### D. Database Configuration

Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=your_host
DB_PORT=3306
DB_DATABASE=visitor_kai
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

### E. Run Migrations

```bash
# Run migrations (safe untuk existing database)
php artisan migrate --force

# OR Reset & seed (HANYA untuk fresh install)
php artisan migrate:fresh --seed --force
```

### F. Set Permissions

```bash
# For Laravel app
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 755 public/

# Set owner
chown -R www-data:www-data /var/www/visitor-kai/
```

### G. Production Optimization

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

---

## 3. WEB SERVER CONFIGURATION

### A. Apache (httpd.conf or VirtualHost)

```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    
    DocumentRoot /var/www/visitor-kai/public
    
    <Directory /var/www/visitor-kai/public>
        AllowOverride All
        Require all granted
        
        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^(.*)$ index.php [QSA,L]
        </IfModule>
    </Directory>
    
    # Logs
    ErrorLog ${APACHE_LOG_DIR}/visitor-kai-error.log
    CustomLog ${APACHE_LOG_DIR}/visitor-kai-access.log combined
</VirtualHost>
```

### B. Nginx (nginx.conf or site-available)

```nginx
upstream php_backend {
    server unix:/var/run/php/php8.2-fpm.sock;
}

server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    
    root /var/www/visitor-kai/public;
    index index.php;
    
    # Logging
    access_log /var/log/nginx/visitor-kai-access.log;
    error_log /var/log/nginx/visitor-kai-error.log;
    
    # Redirect to index.php
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    # PHP handling
    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass php_backend;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
    
    # Deny access to hidden files
    location ~ /\. {
        deny all;
    }
    
    # Static assets caching
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }
}
```

---

## 4. SSL/HTTPS SETUP (Let's Encrypt)

### Using Certbot (Recommended)

```bash
# Install certbot
sudo apt-get install certbot python3-certbot-apache
# or for nginx:
sudo apt-get install certbot python3-certbot-nginx

# Generate certificate
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com
# or for nginx:
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal
sudo certbot renew --dry-run
```

### Manual Apache VirtualHost for HTTPS

```apache
<VirtualHost *:443>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    
    DocumentRoot /var/www/visitor-kai/public
    
    SSLEngine on
    SSLCertificateFile /etc/letsencrypt/live/yourdomain.com/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/yourdomain.com/privkey.pem
    
    # ... rest of config same as above
</VirtualHost>

# Redirect HTTP to HTTPS
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    Redirect permanent / https://yourdomain.com/
</VirtualHost>
```

---

## 5. ENVIRONMENT VARIABLES FOR PRODUCTION

Pastikan `.env` file Anda memiliki:

```env
# Application
APP_NAME="Visitor KAI"
APP_ENV=production
APP_KEY=base64:xxxxx (generate dulu: php artisan key:generate)
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=visitor_kai
DB_USERNAME=root
DB_PASSWORD=securepassword

# Session
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIES=true

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error

# Mail (optional)
MAIL_MAILER=log
# MAIL_MAILER=smtp
# MAIL_HOST=smtp.mailtrap.io
# MAIL_PORT=2525
# MAIL_USERNAME=xxx
# MAIL_PASSWORD=xxx

# Cache
CACHE_STORE=file

# Queue (optional)
QUEUE_CONNECTION=sync
```

---

## 6. BACKUP STRATEGY

### Daily Database Backup

```bash
#!/bin/bash
# File: /usr/local/bin/backup-visitor-kai.sh

BACKUP_DIR="/backup/visitor-kai"
DB_NAME="visitor_kai"
DB_USER="root"
DB_PASSWORD="password"
DATE=$(date +%Y%m%d_%H%M%S)

mkdir -p $BACKUP_DIR

# Database backup
mysqldump -u $DB_USER -p$DB_PASSWORD $DB_NAME | gzip > $BACKUP_DIR/db_$DATE.sql.gz

# Keep only last 7 days
find $BACKUP_DIR -name "db_*.sql.gz" -mtime +7 -delete

echo "Backup completed: $BACKUP_DIR/db_$DATE.sql.gz"
```

Add to crontab:
```bash
0 2 * * * /usr/local/bin/backup-visitor-kai.sh
```

---

## 7. MONITORING & HEALTH CHECK

### Setup Monitoring Script

```bash
#!/bin/bash
# File: /usr/local/bin/check-visitor-kai.sh

APP_URL="https://yourdomain.com"
LOG_FILE="/var/log/visitor-kai-health.log"

# Check if site is up
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" $APP_URL)

if [ $HTTP_CODE -eq 200 ]; then
    echo "[$(date)] ✅ Site is UP (HTTP $HTTP_CODE)" >> $LOG_FILE
else
    echo "[$(date)] ❌ Site is DOWN (HTTP $HTTP_CODE)" >> $LOG_FILE
    # Send alert email here if needed
fi

# Check disk space
DISK_USAGE=$(df -h / | grep / | awk '{print $(NF-1)}')
echo "[$(date)] Disk usage: $DISK_USAGE" >> $LOG_FILE
```

Add to crontab (every 5 minutes):
```bash
*/5 * * * * /usr/local/bin/check-visitor-kai.sh
```

---

## 8. TROUBLESHOOTING

### Issue: Blank white page / 500 error

```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear all cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Verify permissions
ls -la storage/ # should show drwxr-xr-x or better
ls -la bootstrap/cache/

# Rebuild cache
php artisan config:cache
php artisan view:cache
```

### Issue: Cannot write to storage

```bash
# Fix permissions
sudo chown -R www-data:www-data /var/www/visitor-kai/storage
sudo chown -R www-data:www-data /var/www/visitor-kai/bootstrap/cache
sudo chmod -R 775 /var/www/visitor-kai/storage
sudo chmod -R 775 /var/www/visitor-kai/bootstrap/cache
```

### Issue: Database migration errors

```bash
# Rollback dan try again
php artisan migrate:rollback --force

# Check migration status
php artisan migrate:status

# Run specific migration
php artisan migrate --path=database/migrations/xxxxx_xxxxx.php
```

### Issue: Composer install timed out

```bash
# Increase timeout
composer install --no-interaction --prefer-dist --optimize-autoloader --timeout=1200
```

---

## 9. POST-DEPLOYMENT VERIFICATION

Checklist untuk verify installation:

- [ ] `curl https://yourdomain.com` returns 200 OK
- [ ] Login pages accessible (`/admin/login`, `/petugas/login`)
- [ ] Database queries working (check logs)
- [ ] File uploads working
- [ ] Email sending working (if configured)
- [ ] SSL certificate valid
- [ ] Storage directory writable
- [ ] No errors in logs
- [ ] Performance acceptable
- [ ] Backups running

---

## 10. ROLLBACK PROCEDURE

Jika ada masalah setelah deployment:

```bash
# 1. Rollback code
cd /var/www/visitor-kai
git revert HEAD
# atau
git checkout previous_tag

# 2. Rollback database
php artisan migrate:rollback

# 3. Clear cache
php artisan cache:clear

# 4. Restart services
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm
```

---

**For additional help:**
- Laravel Documentation: https://laravel.com/docs
- Server logs: `/var/log/nginx/` or `/var/log/apache2/`
- Application logs: `storage/logs/laravel.log`

