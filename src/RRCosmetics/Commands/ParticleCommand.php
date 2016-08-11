<?php

namespace RRCosmetics\Commands;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;

use RRCosmetics\Main;

class ParticleCommand extends PluginBase {
  
  public $particles_list = array(
      "bubble",
      "crit",
      "critical",
      "dust",
      "enchant",
      "<?php

namespace RRCosmetics\Commands;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;

use RRCosmetics\Main;

class ParticleCommand extends PluginBase {
  
  public $particles_list = array(
      "bubble",
      "crit",
      "critical",
      "dust",
      "enchant",
      "inenchant",
      "instantenchant",
      "explode",
      "largeexplode",
      "hugeexplode",
      "enflame",
      "entityflame",
      "flame",
      "heart",
      "ink",
      "itembreak",
      "lavadrip",
      "lava",
      "portal",
      "redstone",
      "smoke",
      "splash",
      "spore",
      "terrain",
      "waterdrip",
      "water",
      "enchtable",
      "enchanttable",
      "happyvillager",
      "angryvillager",
      "rainsplash",
      "destroyblock"
    );
  
  private $plugin;
    
  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
  }
    
  public function getPlugin() {
    return $this->plugin;
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    $config = new Config($this->plugin->getDataFolder() . "particles.json", Config::JSON);
    switch($cmd->getName()) {
      case "par":
        if($sender->isOp()) {
          if(!(isset($args[0]))) {
            $sender->sendMessage("§dUsage: §f/par <particle name> §7OR §f/par pack < particle pack name>");
          }
          switch($args[1]) {
            case "set":
              if(!(isset($args[2]))) {
                $sender->sendMessage($this->plugin->prefix . "§cYou must specify a player");
              } else {
                $target = $this->plugin->getServer()->getPlayer($args[2]);
                if($target !== null) {
                  $name = strtolower($target->getName());
                  if(!(isset($args[3]))) {
                    $sender->sendMessage($this->plugin->prefix . "§cYou must specify a particle");
                  } else {
                    if(in_array($args[3], $this->particles_list)) {
                      $config->set($name, $args[3]);
                      $config->save();
                    } else {
                      $sender->sendMessage($this->plugin->prefix . "§cThis particle doesn't exist");
                    }
                  }
                } else {
                  $sender->sendMessage($this->plugin->prefix . "§cThis player is offline");
                }
              }
            break;
            
            case "reset":
              if(!(isset($args[2]))) {
                $sender->sendMessage($this->plugin->prefix . "§cYou must specify a player");
              } else {
                $target = $this->plugin->getServer()->getPlayer($args[2]);
                if($target !== null) {
                  
                  $this->removeParticles($target);
                  
                  $sender->sendMessage($this->plugin->prefix . "§aSuccessfully reset particles for §2" . $name . "§a!");
                } else {
                  $sender->sendMessage($this->plugin->prefix . "§cThis player is offline");
              }
            break;
          }
        }
      break;
    } else {
      $sender->sendMessage("§c§lX§r§c You do not have permission for this command");
    }
  }
  
  public function removeParticles(Player $player) {
    $config = new Config($this->plugin->getDataFolder() . "particles.json", Config::JSON);
    $name = strtolower($player->getName());
    $config->set($name, null);
    $config->save();
  }
}",
      "instantenchant",
      "explode",
      "largeexplode",
      "hugeexplode",
      "enflame",
      "entityflame",
      "flame",
      "heart",
      "ink",
      "itembreak",
      "lavadrip",
      "lava",
      "portal",
      "redstone",
      "smoke",
      "splash",
      "spore",
      "terrain",
      "waterdrip",
      "water",
      "enchtable",
      "enchanttable",
      "happyvillager",
      "angryvillager",
      "rainsplash",
      "destroyblock"
    );
  
  private $plugin;
    
  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
  }
    
  public function getPlugin() {
    return $this->plugin;
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    $config = new Config($this->plugin->getDataFolder() . "particles.json", Config::JSON);
    switch($cmd->getName()) {
      case "par":
        if($sender->isOp()) {
          if(!(isset($args[0]))) {
            $sender->sendMessage("§dUsage: §f/par <particle name> §7OR §f/par pack < particle pack name>");
          }
          switch($args[1]) {
            case "set":
              if(!(isset($args[2]))) {
                $sender->sendMessage($this->plugin->prefix . "§cYou must specify a player");
              } else {
                $target = $this->plugin->getServer()->getPlayer($args[2]);
                if($target !== null) {
                  $name = strtolower($target->getName());
                  if(!(isset($args[3]))) {
                    $sender->sendMessage($this->plugin->prefix . "§cYou must specify a particle");
                  } else {
                    if(in_array($args[3], $this->particles_list)) {
                      $config->set($name, $args[3]);
                      $config->save();
                    } else {
                      $sender->sendMessage($this->plugin->prefix . "§cThis particle doesn't exist");
                    }
                  }
                } else {
                  $sender->sendMessage($this->plugin->prefix . "§cThis player is offline");
                }
              }
            break;
            
            case "reset":
              if(!(isset($args[2]))) {
                $sender->sendMessage($this->plugin->prefix . "§cYou must specify a player");
              } else {
                $target = $this->plugin->getServer()->getPlayer($args[2]);
                if($target !== null) {
                  
                  $this->removeParticles($target);
                  
                  $sender->sendMessage($this->plugin->prefix . "§aSuccessfully reset particles for §2" . $name . "§a!");
                } else {
                  $sender->sendMessage($this->plugin->prefix . "§cThis player is offline");
              }
            break;
          }
        } else {
          $sender->sendMessage("§c§lX§r§c You do not have permission for this command");
        }
      break;
    }
  }
  
  public function removeParticles(Player $player) {
    $config = new Config($this->plugin->getDataFolder() . "particles.json", Config::JSON);
    $name = strtolower($player->getName());
    $config->set($name, null);
    $config->save();
  }
}
