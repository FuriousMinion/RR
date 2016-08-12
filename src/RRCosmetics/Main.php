<?php

namespace RRCosmetics;

use pocketmine\plugin\PluginBase;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\utils\Config;

use RRCosmetics\Commands\ParticleCommand;
use RRCosmetics\Commands\CostumeCommand;
use RRCosmetics\Commands\GadgetCommand;

use RRCosmetics\Tasks\ParticleTask;

class Main extends PluginBase {

  public $prefix = "§8[ §l§b-§4Rede§cRealm§b- §8] ";
  
  public function onEnable() {
    $this->regCommands();
    $this->regTasks();
    if(!(is_dir($this->getDataFolder()))) {
      @mkdir($this->getDataFolder());
      $this->saveDefaultConfig();
    }
    $this->getLogger()->info("RRCosmetics Enabled");
  }
  
  public function regCommands() {
    $this->getCommand("par")->setExecutor(new ParticleCommand($this), $this);
  }
  
  public function regTasks() {
    $this->getServer()->getPluginManager()->scheduleRepeatingTask(new ParticleTask($this), 10);
  }
}
