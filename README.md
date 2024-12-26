# Laravel 維護模式排程器

這個套件可以讓你為 Laravel 應用程式設定預定的維護時間。

## 安裝 
```bash
composer require spotwizard/maintenance-scheduler
```

## 設定

發布設定檔：
```bash
php artisan vendor:publish --provider="Vendor\MaintenanceScheduler\MaintenanceSchedulerServiceProvider"
```

## 使用方法

設定維護模式：
```bash
php artisan maintenance:schedule --start="2024-03-20 22:00" --end="2024-03-21 02:00"
```

取消維護模式：
```bash
php artisan maintenance:cancel
```
## 設定選項

在 `config/maintenance-scheduler.php` 中可以設定：

- `allowed_ips`: 維護模式時允許訪問的 IP 列表
- `secret`: 維護模式的訪問密鑰

## License

MIT