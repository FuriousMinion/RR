<?php

namespace RRCosmetics\Tasks;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\math\Vector3;

use pocketmine\level\Level;
use pocketmine\level\Position;

use pocketmine\level\particle\BubbleParticle as bubble;
use pocketmine\level\particle\CriticalParticle as critical;
use pocketmine\level\particle\DustParticle as dust;
use pocketmine\level\particle\EnchantParticle as enchant;
use pocketmine\level\particle\InstantEnchantParticle as inenchant;
use pocketmine\level\particle\ExplodeParticle as explode;
use pocketmine\level\particle\LargeExplodeParticle as largeexplode;
use pocketmine\level\particle\HugeExplodeParticle as hugeexplode;
use pocketmine\level\particle\EntityFlameParticle as entflame;
use pocketmine\level\particle\FlameParticle as flame;
use pocketmine\level\particle\HeartParticle as heart;
use pocketmine\level\particle\InkParticle as ink;
use pocketmine\level\particle\ItemBreakParticle as itembreak;
use pocketmine\level\particle\LavaDripParticle as lavadrip;
use pocketmine\level\particle\LavaParticle as lava;
use pocketmine\level\particle\PortalParticle as portal;
use pocketmine\level\particle\RedstoneParticle as redstone;
use pocketmine\level\particle\SmokeParticle as smoke;
use pocketmine\level\particle\SplashParticle as splash;
use pocketmine\level\particle\SporeParticle as spore;
use pocketmine\level\particle\TerrainParticle as terrain;
use pocketmine\level\particle\WaterDripParticle as waterdrip;
use pocketmine\level\particle\WaterParticle as water;
use pocketmine\level\particle\EnchantmentTableParticle as enchanttable;
use pocketmine\level\particle\HappyVillagerParticle as happyvillager;
use pocketmine\level\particle\AngryVillagerParticle as angryvillager;
use pocketmine\level\particle\RainSplashParticle as rainsplash;
use pocketmine\level\particle\DestroyBlockParticle as destroyblock;
use pocketmine\level\particle\Particle;

use RRCosmetics\Main;

class ParticleTask extends PluginTask {
     
  public $player;
  
  private $plugin;
  
  public function __construct(Main $plugin, Player $player) {
    $this->player = $player;
    $this->plugin = $plugin;
		 parent::__construct($plugin);
	}
	
  public function onRun($tick) {
    $config = new Config($this->plugin->getDataFolder() . "particles.json", Config::JSON);
    $name = strtolower($this->player->getName());
    $pos = new Vector3($this->player->getX(), $this->player->getY(), $this->player->getZ());
    $level = $this->plugin->getServer()->getLevelByName("Hub");
    switch($config->get($name)) {
      case "flame":
        $level->addParticle(new flame($pos));
      break;
    }
  }
}
