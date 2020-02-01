<?php
namespace Deceitya\BodyCD;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Player;

class Main extends PluginBase implements Listener
{
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function collisionDetection(PlayerMoveEvent $event)
    {
        $player = $event->getPlayer();
        // プレイヤーのAABB内にいるEntityたち↓
        foreach ($player->level->getNearbyEntities($player->getBoundingBox(), $player) as $entity) {
            // $entityがPlayerの場合
            if ($entity instanceof Player) {
                // (終点($entity) - 始点($player))のベクトルを$entityに与える。申し訳程度の微調整で3で割ってます。
                $entity->setMotion($entity->subtract($player->x, $player->y, $player->z)->divide(3.0));
            }
        }
    }
}
