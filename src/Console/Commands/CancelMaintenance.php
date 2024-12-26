<?php

namespace Spotwizard\MaintenanceScheduler\Console\Commands;

use Illuminate\Console\Command;

class CancelMaintenance extends Command
{
    protected $signature = 'maintenance:cancel';
    
    protected $description = '取消系統維護模式的排程';

    public function handle()
    {
        // 清除排程資訊
        config(['maintenance-scheduler.start_time' => null]);
        config(['maintenance-scheduler.end_time' => null]);
        
        // 確保系統不在維護模式
        $this->call('up');
        
        $this->info('維護模式排程已取消');
    }
} 