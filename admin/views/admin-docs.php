<?php

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wbdn-section-box">
    <h3>معرفی پلاگین</h3>
    <p>پلاگین این‌لاین دون ابزاری قدرتمند برای نمایش محصولات ووکامرس در قالب اسلایدر است. این پلاگین به شما امکان نمایش محصولات را در هر جای سایت با استفاده از شورت‌کد می‌دهد.</p>
</div>

<div class="wbdn-section-box">
    <h3>استفاده از شورت‌کد</h3>
    <p>برای نمایش اسلایدر محصولات، از شورت‌کد زیر استفاده کنید:</p>
    <div class="code-block">
        <code>[inlinedoon]</code>
        <button class="copy-btn" data-copy-text="[inlinedoon]" title="کپی کردن">
            کپی
        </button>
    </div>

    <h4>پارامترهای شورت‌کد:</h4>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>پارامتر</th>
                    <th>توضیحات</th>
                    <th>مثال</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>cat</code></td>
                    <td>اسلاگ دسته‌بندی محصولات</td>
                    <td><code>cat="electronics"</code></td>
                </tr>
                <tr>
                    <td><code>include</code></td>
                    <td>شناسه‌های محصولات خاص (جدا شده با کاما)</td>
                    <td><code>include="123,456,789"</code></td>
                </tr>
                <tr>
                    <td><code>link_text</code></td>
                    <td>متن لینک "مشاهده همه"</td>
                    <td><code>link_text="مشاهده همه محصولات"</code></td>
                </tr>
                <tr>
                    <td><code>link_url</code></td>
                    <td>آدرس لینک دلخواه</td>
                    <td><code>link_url="https://example.com"</code></td>
                </tr>
                <tr>
                    <td><code>exclude</code></td>
                    <td>شناسه‌های محصولات برای حذف (جدا شده با کاما)</td>
                    <td><code>exclude="123,456"</code></td>
                </tr>
                <tr>
                    <td><code>instock</code></td>
                    <td>فیلتر محصولات موجود (true/false)</td>
                    <td><code>instock="true"</code></td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>
        اگر شناسه محصول وارد نشود یا کمتر از تعداد مشخص شده باشد، بقیه محصولات به صورت رندوم(از دسته بندی تعیین شده) مشخص میشوند.
    </p>
    <p>
        اگر آدرس دلخواه وارد نشود، به صورت خودکار لینکِ صفحه اسلاگ وارد شده انتخاب میشود
    </p>
    <p>
        <strong>نکته:</strong> پارامتر <code>instock</code> در شورت‌کد اولویت دارد و تنظیمات پیش‌فرض در پنل مدیریت را نادیده می‌گیرد.
    </p>
</div>

<div class="wbdn-section-box">
    <h3>تنظیمات پیش‌فرض</h3>
    <p>در بخش "تنظیمات اسلایدر" می‌توانید تنظیمات پیش‌فرض زیر را انجام دهید:</p>
    <ul>
        <li><strong>فیلتر محصولات موجود:</strong> تعیین کنید که به صورت پیش‌فرض فقط محصولات موجود نمایش داده شوند یا همه محصولات</li>
        <li><strong>تنظیمات اسلایدر:</strong> تعداد اسلایدها در دستگاه‌های مختلف، فاصله بین اسلایدها، و سایر تنظیمات</li>
        <li><strong>دسترسی:</strong> تعیین کنید چه نقش‌هایی به پنل مدیریت دسترسی داشته باشند</li>
    </ul>
</div>

<div class="wbdn-section-box">
    <h3>نمونه‌های استفاده</h3>

    <h4>نمایش محصولات یک دسته‌بندی:</h4>
    <div class="code-block">
        <code>[inlinedoon cat="electronics"]</code>
        <button class="copy-btn" data-copy-text="[inlinedoon cat=&quot;electronics&quot;]" title="کپی کردن">
           کپی
        </button>
    </div>

    <h4>نمایش محصولات خاص:</h4>
    <div class="code-block">
        <code>[inlinedoon include="123,456,789"]</code>
        <button class="copy-btn" data-copy-text="[inlinedoon include=&quot;123,456,789&quot;]" title="کپی کردن">
            کپی
        </button>
    </div>

    <h4>نمایش محصولات با لینک سفارشی:</h4>
    <div class="code-block">
        <code>[inlinedoon cat="books" link_text="مشاهده همه کتاب‌ها" link_url="https://example.com/books"]</code>
        <button class="copy-btn" data-copy-text="[inlinedoon cat=&quot;books&quot; link_text=&quot;مشاهده همه کتاب‌ها&quot; link_url=&quot;https://example.com/books&quot;]" title="کپی کردن">
          کپی
        </button>
    </div>

    <h4>حذف محصولات خاص:</h4>
    <div class="code-block">
        <code>[inlinedoon cat="electronics" exclude="123,456"]</code>
        <button class="copy-btn" data-copy-text="[inlinedoon cat=&quot;electronics&quot; exclude=&quot;123,456&quot;]" title="کپی کردن">
            کپی
        </button>
    </div>

    <h4>فقط محصولات موجود:</h4>
    <div class="code-block">
        <code>[inlinedoon cat="electronics" instock="true"]</code>
        <button class="copy-btn" data-copy-text="[inlinedoon cat=&quot;electronics&quot; instock=&quot;true&quot;]" title="کپی کردن">
            کپی
        </button>
    </div>

    <h4>ترکیب پارامترها:</h4>
    <div class="code-block">
        <code>[inlinedoon cat="clothing" include="100,200" exclude="300" instock="true" link_text="خرید از فروشگاه"]</code>
        <button class="copy-btn" data-copy-text="[inlinedoon cat=&quot;clothing&quot; include=&quot;100,200&quot; exclude=&quot;300&quot; instock=&quot;true&quot; link_text=&quot;خرید از فروشگاه&quot;]" title="کپی کردن">
            کپی
        </button>
    </div>
</div>


<div class="wbdn-section-box">
    <h3>مشکلات رایج و راه‌حل</h3>

    <h4>اسلایدر نمایش داده نمی‌شود:</h4>
    <ul>
        <li>اطمینان حاصل کنید که ووکامرس فعال است</li>
        <li>بررسی کنید که محصولات در دسته‌بندی مشخص شده وجود دارند</li>
        <li>مطمئن شوید که محصولات موجود در انبار هستند</li>
    </ul>

    <h4>محصولات تصادفی نمایش داده نمی‌شوند:</h4>
    <ul>
        <li>بررسی کنید که دسته‌بندی با اسلاگ صحیح وجود دارد</li>
        <li>اطمینان حاصل کنید که محصولات کافی در دسته‌بندی وجود دارد</li>
    </ul>

    <h4>مشکل در نمایش استایل‌ها:</h4>
    <ul>
        <li>بررسی کنید که فایل‌های CSS به درستی لود می‌شوند</li>
        <li>مطمئن شوید که تم شما با استایل‌های پلاگین تداخل ندارد</li>
    </ul>
</div>

<div class="wbdn-section-box">
    <h3>ارتباط با من</h3>
    <p>برای گزارش مشکلات یا ارائه ایده از روش‌های زیر اقدام کنید:</p>
    <ul>
        <li>وب‌سایت: <a href="https://webdoon.ir" target="_blank">webdoon.ir</a></li>
        <li>نویسنده: بارمان شکوهی</li>
    </ul>
</div>

<div class="wbdn-section-box">
    <h3>نسخه</h3>
    <p>نسخه فعلی: 1.0.1</p>
</div>

