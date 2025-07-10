# Petunjuk Penggunaan Gambar Background

## Cara Menempatkan Gambar Background

1. **Upload gambar Anda ke folder ini**: `public/images/`
   
2. **Format yang disarankan**:
   - Format: JPG, PNG, WebP
   - Resolusi minimal: 1920x1080 (Full HD)
   - Ukuran file: maksimal 2MB untuk performa optimal

3. **Nama file yang disarankan**:
   - `hero-bg.jpg` untuk background hero section
   - `services-bg.jpg` untuk background section layanan
   - `features-bg.jpg` untuk background section fitur

## Cara Mengaktifkan Background Gambar

Setelah upload gambar, edit file `resources/views/welcome.blade.php`:

### Untuk Hero Section:
Cari bagian CSS `.hero-gradient` dan uncomment baris berikut:
```css
.hero-gradient {
    /* Uncomment baris di bawah ini dan ganti nama file sesuai gambar Anda */
    background-image: url('/images/hero-bg.jpg');
    background-size: cover;
    background-position: center;
    background-blend-mode: overlay;
}
```

### Tips:
- `background-blend-mode: overlay` akan mencampur gambar dengan gradien warna
- Gunakan `background-size: cover` agar gambar menutupi seluruh area
- Gunakan `background-position: center` untuk posisi gambar di tengah

## Contoh Implementasi:
```css
.hero-gradient {
    background: linear-gradient(135deg, rgba(14, 165, 233, 0.8) 0%, rgba(56, 189, 248, 0.8) 50%, rgba(2, 132, 199, 0.8) 100%);
    background-image: url('/images/hero-bg.jpg');
    background-size: cover;
    background-position: center;
    background-blend-mode: overlay;
}
```

Dengan cara ini, gambar akan tetap terlihat dengan overlay gradien sky blue yang elegan.
