# InlineDoon - WooCommerce Product Slider Plugin

[![WordPress](https://img.shields.io/badge/WordPress-5.0+-blue.svg)](https://wordpress.org/)
[![WooCommerce](https://img.shields.io/badge/WooCommerce-3.0+-green.svg)](https://woocommerce.com/)
[![PHP](https://img.shields.io/badge/PHP-7.4+-purple.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-GPL%20v2-red.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

A powerful WordPress plugin for displaying WooCommerce products in beautiful, responsive sliders using Swiper.js. Perfect for showcasing your products anywhere on your website with customizable shortcodes.

## 🌟 Features

- **🎯 Easy Shortcode Integration** - Display products anywhere with simple shortcodes
- **📱 Fully Responsive** - Optimized for mobile, tablet, and desktop
- **⚙️ Highly Customizable** - Control slides, autoplay, spacing, and more
- **🔄 Smart Product Selection** - Mix specific products with random category products
- **🚫 Product Exclusion** - Exclude specific products from display
- **📦 Stock Filtering** - Show only in-stock products or all products
- **🌍 RTL Support** - Perfect for Persian/Arabic websites
- **🎨 Beautiful Design** - Clean, modern slider interface
- **⚡ Fast Performance** - Lightweight and optimized code
- **🛡️ Secure** - Follows WordPress security best practices

## 📋 Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher
- PHP 7.4 or higher

## 🚀 Installation

### Method 1: WordPress Admin (Recommended)
1. Download the plugin ZIP file
2. Go to **Plugins > Add New > Upload Plugin**
3. Choose the ZIP file and click **Install Now**
4. Activate the plugin

### Method 2: FTP Upload
1. Extract the ZIP file
2. Upload the `inlinedoon` folder to `/wp-content/plugins/`
3. Activate the plugin from **Plugins** menu

## 🎯 Quick Start

### Basic Usage
```
[inlinedoon]
```

### Advanced Usage
```
[inlinedoon cat="electronics" include="123,456" link_text="View All Products" link_url="https://example.com/products"]
```

## 📖 Shortcode Parameters

| Parameter | Description | Example |
|-----------|-------------|---------|
| `cat` | Product category slug | `cat="electronics"` |
| `include` | Specific product IDs (comma-separated) | `include="123,456,789"` |
| `exclude` | Product IDs to exclude (comma-separated) | `exclude="123,456"` |
| `instock` | Filter for in-stock products (true/false) | `instock="true"` |
| `link_text` | Custom "View All" link text | `link_text="Shop Now"` |
| `link_url` | Custom link URL | `link_url="https://example.com"` |

## 🎨 Examples

### Display Electronics Products
```
[inlinedoon cat="electronics"]
```

### Show Specific Products
```
[inlinedoon include="123,456,789"]
```

### Custom Link and Text
```
[inlinedoon cat="books" link_text="Browse All Books" link_url="https://example.com/books"]
```

### Exclude Specific Products
```
[inlinedoon cat="electronics" exclude="123,456"]
```

### Show Only In-Stock Products
```
[inlinedoon cat="electronics" instock="true"]
```

### Combined Parameters
```
[inlinedoon cat="clothing" include="100,200" exclude="300" instock="true" link_text="Shop Collection"]
```

## ⚙️ Settings

Access the settings from **InlineDoon > Settings** in your WordPress admin:

### Slider Configuration
- **Mobile Slides**: Number of products on mobile devices
- **Tablet Slides**: Number of products on tablets
- **Desktop Slides**: Number of products on desktop
- **Space Between**: Gap between products in pixels
- **Autoplay**: Enable/disable automatic sliding
- **Autoplay Delay**: Time each slide is displayed
- **Loop**: Enable/disable continuous loop
- **RTL**: Enable/disable right-to-left direction
- **Stock Filter**: Default setting for showing only in-stock products

### Access Control
- Configure which user roles can access the plugin admin
- Administrator always has full access

## 🔧 How It Works

1. **Product Selection**: The plugin first shows products specified in `include` parameter
2. **Category Fill**: Then adds random products from the specified category
3. **Stock Filter**: Only displays products that are in stock
4. **Limit**: Maximum 12 products per slider
5. **Swiper Integration**: Uses Swiper.js for smooth, responsive sliding

## 🎨 Customization

### CSS Customization
You can customize the slider appearance by editing:
- `assets/css/frontend.css` - Main slider styles
- `assets/css/swiper.css` - Swiper library styles

### JavaScript Customization
The slider behavior can be modified in:
- `assets/js/frontend.js` - Frontend slider logic

## 🐛 Troubleshooting

### Slider Not Displaying
- Ensure WooCommerce is active
- Check that products exist in the specified category
- Verify products are in stock

### Random Products Not Showing
- Confirm the category slug is correct
- Ensure sufficient products exist in the category

### Styling Issues
- Check for theme conflicts
- Verify CSS files are loading properly
- Clear any caching plugins

## 📞 Support

- **Website**: [webdoon.ir](https://webdoon.ir)
- **Author**: Barmaan Shokoohi
- **Version**: 1.0.0

## 📄 License

This plugin is licensed under the GPL v2 or later.

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📝 Changelog

### Version 1.0.0
- Initial release
- Basic shortcode functionality
- Responsive slider design
- Admin settings panel
- RTL support
- Persian language support

---

# این‌لاین دون - پلاگین اسلایدر محصولات ووکامرس

پلاگین قدرتمند وردپرس برای نمایش محصولات ووکامرس در اسلایدرهای زیبا و ریسپانسیو با استفاده از Swiper.js. مناسب برای نمایش محصولات در هر جای وب‌سایت با شورت‌کدهای قابل تنظیم.

## 🌟 ویژگی‌ها

- **🎯 ادغام آسان شورت‌کد** - نمایش محصولات در هر جای سایت با شورت‌کدهای ساده
- **📱 کاملاً ریسپانسیو** - بهینه‌شده برای موبایل، تبلت و دسکتاپ
- **⚙️ قابل تنظیم بالا** - کنترل اسلایدها، اتوپلی، فاصله و بیشتر
- **🔄 انتخاب هوشمند محصولات** - ترکیب محصولات خاص با محصولات تصادفی دسته‌بندی
- **🌍 پشتیبانی RTL** - مناسب برای وب‌سایت‌های فارسی/عربی
- **🎨 طراحی زیبا** - رابط اسلایدر تمیز و مدرن
- **⚡ عملکرد سریع** - کد سبک و بهینه‌شده
- **🛡️ امن** - از بهترین روش‌های امنیتی وردپرس پیروی می‌کند

## 📋 پیش‌نیازها

- وردپرس 5.0 یا بالاتر
- ووکامرس 3.0 یا بالاتر
- PHP 7.4 یا بالاتر

## 🚀 نصب

### روش 1: پنل مدیریت وردپرس (توصیه شده)
1. فایل ZIP پلاگین را دانلود کنید
2. به **افزونه‌ها > افزودن > بارگذاری افزونه** بروید
3. فایل ZIP را انتخاب کرده و **نصب** را کلیک کنید
4. پلاگین را فعال کنید

### روش 2: آپلود FTP
1. فایل ZIP را استخراج کنید
2. پوشه `inlinedoon` را به `/wp-content/plugins/` آپلود کنید
3. پلاگین را از منوی **افزونه‌ها** فعال کنید

## 🎯 شروع سریع

### استفاده پایه
```
[inlinedoon]
```

### استفاده پیشرفته
```
[inlinedoon cat="electronics" include="123,456" link_text="مشاهده همه محصولات" link_url="https://example.com/products"]
```

## 📖 پارامترهای شورت‌کد

| پارامتر | توضیحات | مثال |
|---------|---------|------|
| `cat` | اسلاگ دسته‌بندی محصولات | `cat="electronics"` |
| `include` | شناسه‌های محصولات خاص (جدا شده با کاما) | `include="123,456,789"` |
| `link_text` | متن لینک "مشاهده همه" سفارشی | `link_text="خرید کنید"` |
| `link_url` | آدرس لینک سفارشی | `link_url="https://example.com"` |

## 🎨 نمونه‌ها

### نمایش محصولات الکترونیک
```
[inlinedoon cat="electronics"]
```

### نمایش محصولات خاص
```
[inlinedoon include="123,456,789"]
```

### لینک و متن سفارشی
```
[inlinedoon cat="books" link_text="مشاهده همه کتاب‌ها" link_url="https://example.com/books"]
```

### ترکیب پارامترها
```
[inlinedoon cat="clothing" include="100,200" link_text="خرید از مجموعه"]
```

## ⚙️ تنظیمات

از **این‌لاین دون > تنظیمات** در پنل مدیریت وردپرس به تنظیمات دسترسی پیدا کنید:

### پیکربندی اسلایدر
- **اسلایدهای موبایل**: تعداد محصولات در دستگاه‌های موبایل
- **اسلایدهای تبلت**: تعداد محصولات در تبلت‌ها
- **اسلایدهای دسکتاپ**: تعداد محصولات در دسکتاپ
- **فاصله بین**: فاصله بین محصولات به پیکسل
- **اتوپلی**: فعال/غیرفعال کردن اسلاید خودکار
- **تاخیر اتوپلی**: مدت زمان نمایش هر اسلاید
- **حلقه**: فعال/غیرفعال کردن تکرار مداوم
- **RTL**: فعال/غیرفعال کردن راست به چپ

### کنترل دسترسی
- تنظیم اینکه کدام نقش‌های کاربری به پنل مدیریت پلاگین دسترسی داشته باشند
- مدیرکل همیشه دسترسی کامل دارد

## 🔧 نحوه عملکرد

1. **انتخاب محصولات**: پلاگین ابتدا محصولات مشخص شده در پارامتر `include` را نمایش می‌دهد
2. **پر کردن دسته‌بندی**: سپس محصولات تصادفی از دسته‌بندی مشخص شده را اضافه می‌کند
3. **فیلتر موجودی**: فقط محصولات موجود در انبار را نمایش می‌دهد
4. **محدودیت**: حداکثر 12 محصول در هر اسلایدر
5. **ادغام Swiper**: از Swiper.js برای اسلاید روان و ریسپانسیو استفاده می‌کند

## 🎨 سفارشی‌سازی

### سفارشی‌سازی CSS
می‌توانید ظاهر اسلایدر را با ویرایش موارد زیر سفارشی کنید:
- `assets/css/frontend.css` - استایل‌های اصلی اسلایدر
- `assets/css/swiper.css` - استایل‌های کتابخانه Swiper

### سفارشی‌سازی JavaScript
رفتار اسلایدر را می‌توان در موارد زیر تغییر داد:
- `assets/js/frontend.js` - منطق اسلایدر فرانت‌اند

## 🐛 عیب‌یابی

### اسلایدر نمایش داده نمی‌شود
- اطمینان حاصل کنید که ووکامرس فعال است
- بررسی کنید که محصولات در دسته‌بندی مشخص شده وجود دارند
- مطمئن شوید که محصولات موجود در انبار هستند

### محصولات تصادفی نمایش داده نمی‌شوند
- اسلاگ دسته‌بندی را تأیید کنید
- اطمینان حاصل کنید که محصولات کافی در دسته‌بندی وجود دارد

### مشکلات استایل
- بررسی تداخل با تم
- تأیید بارگذاری صحیح فایل‌های CSS
- کش پلاگین‌ها را پاک کنید

## 📞 پشتیبانی

- **وب‌سایت**: [webdoon.ir](https://webdoon.ir)
- **نویسنده**: بارمان شکوهی
- **نسخه**: 1.0.1

## 📄 مجوز

این پلاگین تحت مجوز GPL v2 یا بالاتر منتشر شده است.

## 🤝 مشارکت

مشارکت‌ها خوشامد است! لطفاً Pull Request ارسال کنید.

## 📝 تغییرات

### نسخه 1.0.1
- اضافه شدن پارامتر `exclude` برای حذف محصولات خاص
- اضافه شدن پارامتر `instock` برای فیلتر محصولات موجود
- تنظیمات پیش‌فرض فیلتر موجودی در پنل مدیریت
- بهبود مستندات و راهنمای استفاده
- رفع مشکلات جزئی

### نسخه 1.0.0
- انتشار اولیه
- عملکرد پایه شورت‌کد
- طراحی اسلایدر ریسپانسیو
- پنل تنظیمات مدیریت
- پشتیبانی RTL
- پشتیبانی زبان فارسی