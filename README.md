# Currency Converter va Weather Info

Bu loyiha valyutalarni almashtirish va ob-havo ma'lumotlarini ko'rsatish uchun mo'ljallangan. Loyihada **HTML**, **CSS**, **Bootstrap**, va **PHP** texnologiyalari qo'llanilgan. Valyutani almashtirish uchun **O'zbekiston Markaziy Banki API** va ob-havo ma'lumotlari uchun **OpenWeatherMap API** dan foydalaniladi. Bundan tashqari siz 'currencyConverterWeatherbot' username orqali yuqoridagi ishlarni telegramda bot orqali amalga oshirishingiz mumkin.

## Xususiyatlar

- Valyutani o'zbek so'midan boshqa valyutaga va aksincha almashtirish.
- Ob-havo ma'lumotlarini olish (masalan, harorat, namlik va havo holati).
- Yangi qo'shilgan **Ob-Havo** tugmasi orqali ob-havo ma'lumotlarini ko'rish.
- Telegram bot orqali ko'rish imkoni

## Texnologiyalar

- Til: **PHP**
- Frontend: **HTML**, **CSS**, **Bootstrap**
- Valyuta API: [O'zbekiston Markaziy Banki API](https://cbu.uz/uz/arkhiv-kursov-valyut/json/)
- Ob-Havo API: [OpenWeatherMap API](https://openweathermap.org/api)
- Bot API: (https://api.telegram.org/bot)

## Talablar

Loyihani ishga tushirish uchun quyidagi dasturlar o'rnatilgan bo'lishi kerak:

- Apache yoki Nginx serveri (masalan, **XAMPP**, **WAMP**, yoki **MAMP**)
- PHP 7.4 yoki undan yuqori versiya
- Composerni require qilish

## Loyihani o'rnatish

Quyidagi buyruqlar orqali loyihani klonlashingiz mumkin:

```bash
git clone https://github.com/nodirbekerkabayev/currencyConverter.git
cd currencyConverter
