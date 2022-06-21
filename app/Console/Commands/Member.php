<?php

namespace App\Console\Commands;

use App\Models\Group;
use App\Models\User;
use Illuminate\Console\Command;

class Member extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:member';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавить пользователя user_id в группу group_id';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * Получение даннных от пользователя
         */
        $user_id = $this->ask('Введите user_id:');
        $group_id = $this->ask('Введите group_id');

        /**
         * Запросы в БД
         */
        $user = User::with('groups')->find($user_id);
        $group = Group::with('users')->find($group_id);

        /**
         * Alert
         */
        if ($this->confirm("Вы действительно хотите добавить пользователя $user->name в группу $group->name?")) {

            /**
             * Если пользователь не активен (active == false), активировать его (active = true)
             */
            if (!$user->is_active) {
                $user->is_active = true;
                $user->save();
            }

            /**
             * Время через которое пользователь будет удален из группы
             */
            $date_now = now('+4');
            $expired_at = $date_now->addHours($group->expire_hours);

            /**
             * Присоединение пользователя к группе
             */
            $user->groups()->attach($group, ['expired_at' => $expired_at]);
        }

        return 0;
    }
}
