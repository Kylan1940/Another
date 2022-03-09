<?php

namespace Kylan1940\SpeedUI;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\Config;
use pocketmine\entity\Living;
use Kylan1940\SpeedUI\Form\{Form, SimpleForm};

class Main extends PluginBase implements Listener {

   public function onEnable() : void {
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
   }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
        if($sender instanceof Player){
         if($cmd->getName() == "speed"){
          $this->Speed($sender);
         } 
        }
        return true;
    }
    
  public function Speed($sender){
        $form = new SimpleForm(function (Player $sender, int $data = null){
            $result = $data;
            if ($result === null) {
                return true;
            }
            switch ($result) {
                case 0:
                  $sender->setMovementSpeed($sender->getMovementSpeed()/(1+0.2*$instance->getEffectLevel()));
                  $sender->sendMessage($this->getConfig()->get("deactive-message"));
                  break;
                case 1:
                  $sender->setMovementSpeed($sender->getMovementSpeed()*(1+0.2*$instance->getEffectLevel()));
                  $sender->sendMessage($this->getConfig()->get("speed-1-message"));
                  break;
                case 2:
                  $sender->sendMessage($this->getConfig()->get("speed-2-message"));
                  break;
                case 3:
                  $sender->sendMessage($this->getConfig()->get("speed-3-message"));
                  break;
            }
        });
            $form->setTitle($this->getConfig()->get("title"));
            $form->addButton($this->getConfig()->get("deactive-button"));
            $form->addButton($this->getConfig()->get("speed-1-button"));
            $form->addButton($this->getConfig()->get("speed-2-button"));
            $form->addButton($this->getConfig()->get("speed-3-button"));
            $form->sendToPlayer($sender);
            return $form;
    }
}
