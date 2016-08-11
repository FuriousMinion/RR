<?php

namespace RRCosmetics;

use pocketmine\plugin\PluginBase;

use pocketmine\Server;
use pocketmine\Player;

use RRCosmetics\Commands\ParticleCommand;
use RRCosmetics\Commands\CostumeCommand;
use RRCosmetics\Commands\GadgetCommand;

class Main extends PluginBase {

  public $prefix = "§8[ §l§b-§4Rede§cRealm§b- §8] ";
  
  public function onEnable() {
    $this->regCommands();
    if(!(is_dir($this->getDataFolder()))) {
      @mkdir($this->getDataFolder());
      $this->saveDefaultConfig();
    }
    $this->getLogger()->info("RRCosmetics Enabled");
  }
  
  public function regCommands() {
    $this->getCommand("par")->setExecutor(new ParticleCommand($this), $this);
    $this->getCommand("costume")->setExecutor(new CostumeCommand($this), $this);
    $this->getCommand("gadget")->setExecutor(new GadgetCommand($this), $this);
  }
}