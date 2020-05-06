<?php


namespace App\Domain\Command;


use App\Command;

class UpdateCurrentCommand
{
    public $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    public function __invoke($status, $result)
    {
        $this->command->status = $status;
        $this->command->result = $result;
        $this->command->update();
    }
}
