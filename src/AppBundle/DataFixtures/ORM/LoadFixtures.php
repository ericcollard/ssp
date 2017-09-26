<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 23/09/2017
 * Time: 21:01
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

use AppBundle\Entity\User;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setUsername('admin');
        $user->setPlainPassword('Colbas13');
        $user->setEnabled(true);
        $user->setEmail('eric.collard@free.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstName('Eric');
        $user->setLastName('COLLARD');
        $manager->persist($user);
        $manager->flush();

        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__.'/fixtures.yml')->getObjects();
        foreach ($objectSet as $object) {
            $manager->persist($object);
        }
        $manager->flush();
    }
}