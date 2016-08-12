<?php

namespace RRCosmetics\Commands;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\utils\Config;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;

use RRCosmetics\Main;

class ParticleCommand extends PluginBase {
  
  public $particles_list = array(
      "bubble",
      "crit",
      "dust",
      "enchant",
      "inenchant",
      "explode",
      "largeexplode",
      "hugeexplode",
      "entflame",
      "flame",
      "heart",
      "ink",
      "item",
      "lavadrip",
      "lava",
      "portal",
      "redstone",
      "smoke",
      "splash",
      "spore",
      "waterdrip",
      "water",
      "enchtable",
      "happyvillager",
      "angryvillager",
      "rainsplash",
      "snowball",
      "slime",
      "block",
      "wimgs"
    );
  
  private $plugin;
    
  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
  }
    
  public function getPlugin() {
    return $this->plugin;
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    switch($cmd->getName()) {
      case "par":
        if($sender->isOp()) {
          if(!(isset($args[0]))) {
            $sender->sendMessage("§l§dUsage: §r§f/par set §7<player> <particle name> §8[data] §l§b| §r§f/par reset §7<player> §l§b| §r§f/par list");
          }
          switch($args[0]) {
          
            case "list":
              //TO DO
            break;
            
            case "set":
            if(!(isset($args[1]))) {
              $sender->sendMessage($this->plugin->prefix . "§r§cYou must specify a player");
            } else {
              $target = $this->plugin->getServer()->getPlayer($args[1]);
              if($target !== null) {
                $name = strtolower($target->getName());
                if(!(isset($args[2]))) {
                  $sender->sendMessage($this->plugin->prefix . "§r§cYou must specify a particle");
                } else {
                  $config = new Config($this->plugin->getDataFolder() . "particles/$name.json", Config::JSON);
                  if(in_array($args[2], $this->particles_list)) {
                    $config->set($name, $args[2]);
                    $config->set("block", null);
                    $config->set("item", null);
                    $config->save();
                    $sender->sendMessage($this->plugin->prefix . "§r§aSuccessfully set particles for §2" . $name . "§a!");
                  } else {
                    $sender->sendMessage($this->plugin->prefix . "§r§cThis particle doesn't exist");
                  }
                  switch($args[2]) {
                    case "item":
                      if(!isset($args[3])) {
                        $sender->sendMessage($this->plugin->prefix . "§r§cYou must specify ID");
                      } else {
                        $config->set("item", $args[3]);
                        $config->save();
                      }
                    break;
                    case "block":
                      if(!isset($args[3])) {
                        $sender->sendMessage($this->plugin->prefix . "§r§cYou must specify ID");
                      } else {
                        $config->set("block", $args[3]);
                        $config->save();
                      }
                    break;
                  }
                }
              } else {
                $sender->sendMessage($this->plugin->prefix . "§r§cThis player is offline");
              }
            }
            break;
            
            case "reset":
              if(!(isset($args[1]))) {
                $sender->sendMessage($this->plugin->prefix . "§r§cYou must specify a player");
              } else {
                $target = $this->plugin->getServer()->getPlayer($args[1]);
                if($target !== null) {
                  
                  $this->removeParticles($target);
                  
                  $name = strtolower($target->getName());
                  $sender->sendMessage($this->plugin->prefix . "§r§aSuccessfully reset particles for §2" . $name . "§a!");
                } else {
                  $sender->sendMessage($this->plugin->prefix . "§r§cThis player is offline");
                }
              }
            break;
            
            case "wings":
              $target = $this->plugin->getServer()->getPlayer($args[1]);
              $name = $target->getName();
              $config = new Config($this->plugin->getDataFolder() . "particles/$name.json", Config::JSON);
              $config->set($name, "wings");
              $config->save();
            break;
            }
        break;
      } else {
        $sender->sendMessage("§4§lX§r§c You do not have permission for this command");
      }
    break;
    }
  }
  
  public function removeParticles(Player $player) {
    $name = strtolower($player->getName());
    $config = new Config($this->plugin->getDataFolder() . "particles/$name.json", Config::JSON);
    $config->set($name, null);
    $config->save();
  }
}
