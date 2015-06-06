<?php

namespace _64FF00\UniqueIdUtils;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\TextFormat;

use pocketmine\utils\Utils;

/* UniqueIdUtils by 64FF00 (xktiverz@gmail.com, @64ff00 for Twitter) */
/*
      # #    #####  #       ####### #######   ###     ###   
      # #   #     # #    #  #       #        #   #   #   #  
    ####### #       #    #  #       #       #     # #     # 
      # #   ######  #    #  #####   #####   #     # #     # 
    ####### #     # ####### #       #       #     # #     # 
      # #   #     #      #  #       #        #   #   #   #  
      # #    #####       #  #       #         ###     ###                                        
                                                                                       
*/

class UniqueIdUtils extends PluginBase implements CommandExecutor
{   
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args)
	{
        if(!isset($args[0]))
        {
            $sender->sendMessage(TextFormat::RED . "Usage: /uuid <info / machine / player / server>");
            
            return true;
        }
        
        switch(strtolower($args[0]))
        {
            case "info":
            
                if(!$sender->hasPermission("uuidutils.info"))
                {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
                }  
                else
                {
                    $author = $this->getDescription()->getAuthors()[0];
                    $version = $this->getDescription()->getVersion();
        
                    $sender->sendMessage(TextFormat::BLUE . "[UniqueIdUtils] You are using UniqueIdUtils v$version by $author.");
                }
                
                break;
                
            case "machine":
            
                if(!$sender->hasPermission("uuidutils.machine"))
                {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
                }  
                else
                {
                    if(!$sender instanceof ConsoleCommandSender)
                    {
                        $sender->sendMessage(TextFormat::RED . "This command can only be run on the console.");
                        
                        break;
                    }
                    
                    $sender->sendMessage("Machine UUID: " . Utils::getMachineUniqueId());
                }
                
                break;
            
            case "player":
            
                if(!$sender->hasPermission("uuidutils.player"))
                {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
                }
                else
                {
                    
                    if(!isset($args[1]))
                    {
                        $sender->sendMessage(TextFormat::RED . "Usage: /uuid player <player>");
                        
                        break;
                    }
                    
                    $player = $this->getServer()->getPlayer($args[1]);
                    
                    if(!$player instanceof Player)
                    {
                        $sender->sendMessage(TextFormat::RED . "Error: Invalid Player.");
                        
                        break;
                    }
                    
                    $sender->sendMessage("Player " . $player->getName() . "'s UUID is: " . $player->getUniqueId());
                }
                
                break;
                
            case "server":
            
                if(!$sender->hasPermission("uuidutils.server"))
                {
                    $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
                }
                else
                {
                    if(!$sender instanceof ConsoleCommandSender)
                    {
                        $sender->sendMessage(TextFormat::RED . "This command can only be run on the console.");
                        
                        break;
                    }
                    
                    $sender->sendMessage("Server UUID: " . $this->getServer()->getServerUniqueId());
                }
                
                break;
                
            default:
            
                $sender->sendMessage(TextFormat::RED . "Usage: /uuid <info / machine / player / server>");
            
                break;
        }
        
        return true;
    }
}