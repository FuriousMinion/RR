<?php

namespace RRCosmetics\Tasks;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\utils\Config;

use pocketmine\math\Vector3;

use pocketmine\level\Level;
use pocketmine\level\Position;

use pocketmine\level\particle\BubbleParticle as bubble;
use pocketmine\level\particle\CriticalParticle as critical;
use pocketmine\level\particle\DustParticle as dust;
use pocketmine\level\particle\EnchantParticle as enchant;
use pocketmine\level\particle\EnchantmentTableParticle as enchanttable;
use pocketmine\level\particle\EntityFlameParticle as entflame;
use pocketmine\level\particle\ExplodeParticle as explode;
use pocketmine\level\particle\FlameParticle as flame;
use pocketmine\level\particle\HappyVillagerParticle as happyvillager;
use pocketmine\level\particle\HeartParticle as heart;
use pocketmine\level\particle\HugeExplodeParticle as hugeexplode;
use pocketmine\level\particle\InstantEnchantParticle as inenchant;
use pocketmine\level\particle\InkParticle as ink;
use pocketmine\level\particle\ItemBreakParticle as itembreak;
use pocketmine\level\particle\LargeExplodeParticle as largeexplode;
use pocketmine\level\particle\LavaDripParticle as lavadrip;
use pocketmine\level\particle\LavaParticle as lava;
use pocketmine\level\particle\PortalParticle as portal;
use pocketmine\level\particle\RainSplashParticle as rainsplash;
use pocketmine\level\particle\RedstoneParticle as redstone;
use pocketmine\level\particle\SmokeParticle as smoke;
use pocketmine\level\particle\SplashParticle as splash;
use pocketmine\level\particle\SporeParticle as spore;
use pocketmine\level\particle\TerrainParticle as terrain;
use pocketmine\level\particle\WaterDripParticle as waterdrip;
use pocketmine\level\particle\AngryVillagerParticle as angryvillager;
use pocketmine\level\particle\WaterParticle as water;
use pocketmine\level\particle\DestroyBlockParticle as destroyblock;
use pocketmine\level\particle\Particle;

use pocketmine\item\Item;
use pocketmine\block\Block;

use RRCosmetics\Main;

class ParticleTask extends PluginTask {

  private $plugin;
  
  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
		 parent::__construct($plugin);
	}
	
  public function onRun($tick) {
    $players = $this->plugin->getServer()->getOnlinePlayers();
    foreach($players as $player) {
      $name = strtolower($player->getName());
      $config = new Config($this->plugin->getDataFolder() . "particles/$name.json", Config::JSON);
      $pos = new Vector3($player->getX(), $player->getY() + 0.5, $player->getZ());
      $level = $this->plugin->getServer()->getLevelByName("Hub");
      switch($config->get($name)) {
        case "bubble":
          $level->addParticle(new bubble($pos));
        break;
        case "crit":
        case "critical":
          $level->addParticle(new critical($pos));
        break;
        case "ench":
        case "enchant":
          $level->addParticle(new enchant($pos));
        break;
        case "dust":
          $level->addParticle(new dust($pos));
        break;
        case "inenchant":
        case "instantenchant":
          $level->addParticle(new inenchant($pos));
        break;
        case "explode":
          $level->addParticle(new explode($pos));
        break;
        case "largeexplode":
          $level->addParticle(new largeexplode($pos));
        break;
        case "hugeexplode":
          $level->addParticle(new hugeexplode($pos));
        break;
        case "entflame":
        case "entityflame":
          $level->addParticle(new entflame($pos));
        break;
        case "flame":
          $level->addParticle(new flame($pos));
        break;
        case "heart":
          $level->addParticle(new heart($pos));
        break;
        case "ink":
          $level->addParticle(new ink($pos));
        break;
        case "lavadrip":
          $level->addParticle(new lavadrip($pos));
        break;
        case "lava":
          $level->addParticle(new lava($pos));
        break;
        case "portal":
          $level->addParticle(new portal($pos));
        break;
        case "portal":
          $level->addParticle(new portal($pos));
        break;
        case "redstone":
          $level->addParticle(new redstone($pos));
        break;
        case "splash":
          $level->addParticle(new splash($pos));
        break;
        case "spore":
          $level->addParticle(new spore($pos));
        break;
        case "terrain":
          $level->addParticle(new terrain($pos, Block::get(round(rand(0, 114)))));
        break;
        case "waterdrip":
          $level->addParticle(new waterdrip($pos));
        break;
        case "water":
          $level->addParticle(new water($pos));
        break;
        case "enchtable":
        case "enchanttable":
          $level->addParticle(new enchanttable($pos));
        break;
        case "happyvillager":
          $level->addParticle(new happyvillager($pos));
        break;
        case "angryvillager":
          $level->addParticle(new angryvillager($pos));
        break;
        case "rainsplash":
          $level->addParticle(new rainsplash($pos));
        break;
        case "snowball":
          $level->addParticle(new itembreak($pos, Item::get(Item::SNOWBALL)));
        break;
        case "slime":
          $level->addParticle(new itembreak($pos, Item::get(Item::SLIMEBALL)));
        break;
        case "itembreak":
          $level->addParticle(new itembreak($pos, Item::get($config->get("item"))));
        break;
        case "destroyblock":
          $level->addParticle(new destroyblock($pos, Block::get($config->get("block"))));
        break;
      }
    }
  }
}
