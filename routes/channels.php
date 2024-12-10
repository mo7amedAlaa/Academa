<?php
Broadcast::channel('new-notification', function ($user) {
    return true; // إرجاع true للسماح لجميع المستخدمين بالوصول إلى القناة
});
