<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor KAI - Security</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .bg-gradient-kai { background: linear-gradient(135deg, #6b46c1 0%, #d53f8c 100%); }
        body { background-color: #f7fafc; }
    </style>
</head>
<body class="flex justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-lg min-h-screen relative flex flex-col">
        @yield('content')

        <nav class="fixed bottom-0 w-full max-w-md bg-white border-t flex justify-around py-3">
            <a href="#" class="text-purple-600 flex flex-col items-center">
                <i class="fas fa-home text-xl"></i>
                <span class="text-xs">Home</span>
            </a>
            <a href="#" class="bg-gradient-kai text-white p-4 rounded-full -mt-10 border-4 border-white">
                <i class="fas fa-qrcode text-2xl"></i>
            </a>
            <a href="#" class="text-gray-400 flex flex-col items-center">
                <i class="fas fa-chart-line text-xl"></i>
                <span class="text-xs">Lihat Data</span>
            </a>
        </nav>
    </div>
</body>
</html>