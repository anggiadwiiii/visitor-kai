<div id="modalBatal" class="modal-overlay">
    <div class="modal-content">
        <div style="margin-bottom: 15px;">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 9V11M12 15H12.01M5.07183 19H18.9282C20.4678 19 21.4301 17.3333 20.6603 16L13.7321 4C12.9623 2.66667 11.0378 2.66667 10.268 4L3.33978 16C2.56998 17.3333 3.53223 19 5.07183 19Z" stroke="#F39C12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="modal-title">Batalkan Permohonan?</div>
        <p class="modal-text">Konfirmasi pembatalan permohonan Anda</p>
        
        <div style="background: #FFF9E6; border: 1px solid #FFE58F; border-radius: 8px; padding: 12px; margin-bottom: 20px; text-align: left;">
            <strong style="color: #856404; font-size: 12px; display: block; margin-bottom: 4px;">Perhatian!</strong>
            <p style="color: #856404; font-size: 10px; margin: 0; line-height: 1.4;">
                Dengan membatalkan permohonan ini, semua dokumen dan data yang telah disubmit akan dihapus dari sistem. Anda perlu mengisi formulir dari awal jika ingin mengajukan kembali.
            </p>
        </div>

        <div class="modal-btns">
            <button class="btn btn-grey" onclick="hideModal('modalBatal')" style="flex:1">Kembali</button>
            <button class="btn" onclick="prosesBatalKeSukses()" style="flex:1; background-color: #E74C3C; color: white;">Batalkan Permohonan</button>
        </div>
    </div>
</div>