<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;

abstract class Service
{
    /**
     * 標準のLoggerインスタンス
     */
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * 各種ログ出力
     */
    protected function emergency($message, array $context = []): void
    {
        $this->logger->emergency($this->formatMessage($message), $context);
    }
    protected function alert($message, array $context = []): void
    {
        $this->logger->alert($this->formatMessage($message), $context);
    }
    protected function critical($message, array $context = []): void
    {
        $this->logger->critical($this->formatMessage($message), $context);
    }
    protected function error($message, array $context = []): void
    {
        $this->logger->error($this->formatMessage($message), $context);
    }
    protected function warning($message, array $context = []): void
    {
        $this->logger->warning($this->formatMessage($message), $context);
    }
    protected function notice($message, array $context = []): void
    {
        $this->logger->notice($this->formatMessage($message), $context);
    }
    protected function info($message, array $context = []): void
    {
        $this->logger->info($this->formatMessage($message), $context);
    }
    protected function debug($message, array $context = []): void
    {
        $this->logger->debug($this->formatMessage($message), $context);
    }
    protected function log($level, $message, array $context = []): void
    {
        $this->logger->log($level, $this->formatMessage($message), $context);
    }

    /**
     * Controllerから呼び出す実行用関数
     * 
     * @param Request $request
     * 
     * @return mixed
     */
    public function excute(Request $request): mixed
    {
        try {
            return DB::transaction(
                callback: fn () => $this->main($request),
                attempts: 3
            );
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 各Service毎の処理を記述する抽象関数
     * 
     * @param Request $request
     * 
     * @return mixed
     */
    abstract public function main(Request $request): mixed;

    /**
     * ログメッセージにクラス名と関数名を追加
     * 
     * @param string $message
     * 
     * @return string
     */
    private function formatMessage(string $message): string
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
        $caller = $trace[2] ?? null;

        $class = $caller['class'] ?? 'Unknown';
        $function = $caller['function'] ?? 'Unknown';

        return "[{$class}::{$function}] {$message}";
    }
}
