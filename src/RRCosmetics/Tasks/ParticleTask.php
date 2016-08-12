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
      "critical",
      "dust",
      "ench",
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
      "rainsplash".
      "snowball".
      "slime".
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
    switch($cmd->getName()) {
      case "par":
        if($sender->isOp()) {
          if(!(isset($args[0]))) {
            $sender->sendMessage("§dUsage: §f/par set <player> <particle name> §7OR §f/par reset <player>");
          }
          switch($args[0]) {
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
                  if(in_array($args[2], $this->particles_list)) {
                    $config = new Config($this->plugin->getDataFolder() . "particles/$name.json", Config::JSON);
                    $config->set($name, $args[2]);
                    $config->save();
                    $sender->sendMessage($this->plugin->prefix . "§r§aSuccessfully set particles for §2" . $name . "§a!");
                  } else {
                    $sender->sendMessage($this->plugin->prefix . "§r§cThis particle doesn't exist");
                  }
                  switch($args[2]) {
                    case "item":
                    case "itembreak":
                      if(!isset($args[3])) {
                        $sender->sendMessage($this->plugin->prefix . "§r§cYou must specify ID");
                      } else {
                        $config->set("item", $args[3]);
                        $config->save();
                        $sender->sendMessage($this->plugin->prefix . "§r§aSuccessfully set particles for §2" . $name . "§a!");
                      }
                    break;
                    case "block":
                    case "blockbreak":
                      if(!isset($args[3])) {
                        $sender->sendMessage($this->plugin->prefix . "§r§cYou must specify ID");
                      } else {
                        $config->set("block", $args[3]);
                        $config->save();
                        $sender->sendMessage($this->plugin->prefix . "§r§aSuccessfully set particles for §2" . $name . "§a!");
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
            }
        break;
      } else {
        $sender->sendMessage("§c§lX§r§c You do not have permission for this command");
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
