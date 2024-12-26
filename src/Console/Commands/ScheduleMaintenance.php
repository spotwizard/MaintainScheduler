<?php

namespace Spotwizard\MaintenanceScheduler\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class ScheduleMaintenance extends Command
{
    protected $signature = 'maintenance:schedule 
                          {--start= : 維護開始時間 (格式: Y-m-d H:i)}
                          {--end= : 維護結束時間 (格式: Y-m-d H:i)}';
    
    protected $description = '設定系統維護模式的排程';

    public function handle()
    {
        $startTime = Carbon::parse($this->option('start'));
        $endTime = Carbon::parse($this->option('end'));
        
        if ($endTime->lte($startTime)) {
            $this->error('結束時間必須大於開始時間！');
            return 1;
        }
        
        // 儲存排程資訊
        config(['maintenance-scheduler.start_time' => $startTime]);
        config(['maintenance-scheduler.end_time' => $endTime]);
        
        $this->info('維護模式已排程：');
        $this->info("開始時間：{$startTime->format('Y-m-d H:i')}");
        $this->info("結束時間：{$endTime->format('Y-m-d H:i')}");
        
        // 設定系統進入維護模式的排程
        $this->call('schedule:work');
    }
} 