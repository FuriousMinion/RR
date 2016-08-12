<?php

namespace RRCosmetics;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\PluginTask;

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
      @mkdir($this->getDataFolder() . "particles");
    }
    $this->getLogger()->info("§a
       _____                                      _
      / ____|                                _   (_)
     | |       ___    ____  _ ___ ___  ____ | |_  _   ___  ____
     | |     /  _  \ | ___|| '_  '_  \/ __ \| __|| | / __|| ___|
     | |____|  (_)  |\___ \| | | | | || ___/| |_ | || (__ \___ \
      \______\ ___ / |____/|_| |_| |_|\____|\___||_| \___||____/
      
    ");
  }
  
  public function regCommands() {
    $this->getCommand("par")->setExecutor(new ParticleCommand($this), $this);
  }
  
  public function regTasks() {
    $this->getServer()->getScheduler()->scheduleRepeatingTask(new ParticleTask($this), 2);
  }
}
