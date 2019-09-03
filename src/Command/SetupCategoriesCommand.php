<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\SubCategory;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SetupCategoriesCommand extends Command
{
    protected static $defaultName = 'app:setupCategories';

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    protected $maxItemId = 20000;
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function __construct(EntityManagerInterface $entityManager, CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->categoryRepository = $categoryRepository;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Add a short description for your command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $classIdentifiers[0]['main'] = 'Consumable';
        $classIdentifiers[0][0] = 'Consumable';
        $classIdentifiers[0][1] = 'Potion';
        $classIdentifiers[0][2] = 'Elixir';
        $classIdentifiers[0][3] = 'Flask';
        $classIdentifiers[0][4] = 'Scroll';
        $classIdentifiers[0][5] = 'Food & Drink';
        $classIdentifiers[0][6] = 'Item Enhancement';
        $classIdentifiers[0][7] = 'Bandage';
        $classIdentifiers[0][8] = 'Other';
        $classIdentifiers[0][-3] = 'Other';
        $classIdentifiers[1]['main'] = 'Container';
        $classIdentifiers[1][0] = 'Bag';
        $classIdentifiers[1][1] = 'Soul Bag';
        $classIdentifiers[1][2] = 'Herb Bag';
        $classIdentifiers[1][3] = 'Enchanting Bag';
        $classIdentifiers[1][4] = 'Engineering Bag';
        $classIdentifiers[1][5] = 'Gem Bag';
        $classIdentifiers[1][6] = 'Mining Bag';
        $classIdentifiers[1][7] = 'Leatherworking Bag';
        $classIdentifiers[1][8] = 'Inscription Bag';
        $classIdentifiers[2]['main'] = 'Weapons';
        $classIdentifiers[2][0] = 'Axe (1h)';
        $classIdentifiers[2][1] = 'Axe (2h)';
        $classIdentifiers[2][2] = 'Bow';
        $classIdentifiers[2][3] = 'Gun';
        $classIdentifiers[2][4] = 'Mace (1h)';
        $classIdentifiers[2][5] = 'Mace (2h)';
        $classIdentifiers[2][6] = 'Polearm';
        $classIdentifiers[2][7] = 'Sword (1h)';
        $classIdentifiers[2][8] = 'Sword (2h)';
        $classIdentifiers[2][9] = 'Obsolete';
        $classIdentifiers[2][10] = 'Staff';
        $classIdentifiers[2][11] = 'Exotic';
        $classIdentifiers[2][12] = 'Exotic';
        $classIdentifiers[2][13] = 'Fist Weapon';
        $classIdentifiers[2][14] = 'Miscellaneous';
        $classIdentifiers[2][15] = 'Dagger';
        $classIdentifiers[2][16] = 'Thrown';
        $classIdentifiers[2][17] = 'Spear';
        $classIdentifiers[2][18] = 'Crossbow';
        $classIdentifiers[2][19] = 'Wand';
        $classIdentifiers[2][20] = 'Fishing Pole';
        $classIdentifiers[3]['main'] = 'Gems';
        $classIdentifiers[3][0] = 'Red';
        $classIdentifiers[3][1] = 'Blue';
        $classIdentifiers[3][2] = 'Yellow';
        $classIdentifiers[3][3] = 'Purple';
        $classIdentifiers[3][4] = 'Green';
        $classIdentifiers[3][5] = 'Orange';
        $classIdentifiers[3][6] = 'Meta';
        $classIdentifiers[3][7] = 'Simple';
        $classIdentifiers[3][8] = 'Prismatic';
        $classIdentifiers[3][-8] = 'unclear (Iron Relic)';
        $classIdentifiers[3][-9] = 'unclear (Knife)';
        $classIdentifiers[3][-10] = 'unclear (shadow relic)';
        $classIdentifiers[3][-11] = 'unclear (relic)';
        $classIdentifiers[3][-12] = 'unclear (arcane relic)';
        $classIdentifiers[3][-13] = 'Bags?';
        $classIdentifiers[3][-14] = 'unclear (fire relic)';
        $classIdentifiers[3][-16] = 'unclear (life relic)';
        $classIdentifiers[3][-17] = 'unclear (some relic)';
        $classIdentifiers[3][-18] = 'unclear (Amulet)';
        $classIdentifiers[4]['main'] = 'Armor';
        $classIdentifiers[4][0] = 'Miscellaneous';
        $classIdentifiers[4][1] = 'Cloth';
        $classIdentifiers[4][2] = 'Leather';
        $classIdentifiers[4][-2] = 'Finger';
        $classIdentifiers[4][3] = 'Mail';
        $classIdentifiers[4][-3] = 'Neck';
        $classIdentifiers[4][4] = 'Plate';
        $classIdentifiers[4][-4] = 'Trinket';
        $classIdentifiers[4][5] = 'Buckler(OBSOLETE)';
        $classIdentifiers[4][-5] = 'Off-hand Frills';
        $classIdentifiers[4][6] = 'Shield';
        $classIdentifiers[4][-6] = 'Back';
        $classIdentifiers[4][7] = 'Libram';
        $classIdentifiers[4][-7] = 'Tabard';
        $classIdentifiers[4][8] = 'Idol';
        $classIdentifiers[4][9] = 'Totem';
        $classIdentifiers[4][10] = 'Sigil';
        $classIdentifiers[4][-8] = 'Shirt';
        $classIdentifiers[5]['main'] = 'Reagents';
        $classIdentifiers[5][0] = 'Reagent';
        $classIdentifiers[6]['main'] = 'Projectile';
        $classIdentifiers[6][0] = 'Wand(OBSOLETE)';
        $classIdentifiers[6][1] = 'Bolt(OBSOLETE)';
        $classIdentifiers[6][2] = 'Arrow';
        $classIdentifiers[6][3] = 'Bullet';
        $classIdentifiers[6][4] = 'Thrown(OBSOLETE)';
        $classIdentifiers[7]['main'] = 'Trade Goods';
        $classIdentifiers[7][0] = 'Trade Goods';
        $classIdentifiers[7][1] = 'Parts';
        $classIdentifiers[7][2] = 'Explosives';
        $classIdentifiers[7][3] = 'Devices';
        $classIdentifiers[7][4] = 'Jewelcrafting';
        $classIdentifiers[7][5] = 'Cloth';
        $classIdentifiers[7][6] = 'Leather';
        $classIdentifiers[7][7] = 'Metal & Stone';
        $classIdentifiers[7][8] = 'Meat';
        $classIdentifiers[7][9] = 'Herb';
        $classIdentifiers[7][10] = 'Elemental';
        $classIdentifiers[7][11] = 'Other';
        $classIdentifiers[7][12] = 'Enchanting';
        $classIdentifiers[7][13] = 'Materials';
        $classIdentifiers[7][14] = 'Armor Enchantment';
        $classIdentifiers[7][15] = 'Weapon Enchantmens';
        $classIdentifiers[8]['main'] = 'Generic(OBSOLETE)';
        $classIdentifiers[8][0] = 'Generic(OBSOLETE)';
        $classIdentifiers[9]['main'] = 'Recipe';
        $classIdentifiers[9][0] = 'Book';
        $classIdentifiers[9][1] = 'Leatherworking';
        $classIdentifiers[9][2] = 'Tailoring';
        $classIdentifiers[9][3] = 'Engineering';
        $classIdentifiers[9][4] = 'Blacksmithing';
        $classIdentifiers[9][5] = 'Cooking';
        $classIdentifiers[9][6] = 'Alchemy';
        $classIdentifiers[9][7] = 'First Aid';
        $classIdentifiers[9][8] = 'Enchanting';
        $classIdentifiers[9][9] = 'Fishing';
        $classIdentifiers[9][10] = 'Jewelcrafting';
        $classIdentifiers[10]['main'] = 'Money(OBSOLETE)';
        $classIdentifiers[10][0] = 'Money(OBSOLETE)';
        $classIdentifiers[11]['main'] = 'Quiver';
        $classIdentifiers[11][0] = 'Quiver(OBSOLETE)';
        $classIdentifiers[11][1] = 'Quiver(OBSOLETE)';
        $classIdentifiers[11][2] = 'Quiver';
        $classIdentifiers[11][3] = 'Ammo Pouch';
        $classIdentifiers[12]['main'] = 'Quest';
        $classIdentifiers[12][0] = 'Quest';
        $classIdentifiers[13]['main'] = 'Key';
        $classIdentifiers[13][0] = 'Key';
        $classIdentifiers[13][1] = 'Lockpick';
        $classIdentifiers[14]['main'] = 'Permanent';
        $classIdentifiers[14][0] = 'Permanent';
        $classIdentifiers[15]['main'] = 'Miscellaneous';
        $classIdentifiers[15][0] = 'Junk';
        $classIdentifiers[15][1] = 'Reagent';
        $classIdentifiers[15][2] = 'Pet';
        $classIdentifiers[15][3] = 'Holiday';
        $classIdentifiers[15][4] = 'Other';
        $classIdentifiers[15][5] = 'Mount';
        $classIdentifiers[15][-2] = 'Armor Token';
        foreach ($classIdentifiers as $classId => $subCategories) {
            foreach ($subCategories as $index => $subCategory) {
                if ($index === 'main') {
                    $category = new Category();
                    $category->setSorting(1);
                    $category->setName($subCategory);
                    $category->setIdentifier($classId);
                } else {
                    $category = new SubCategory();
                    $parentClass = $this->categoryRepository->findOneBy(['identifier' => $classId]);
//                    var_dump($parentClass);
                    $category->setName($subCategory);
                    $category->setSorting(1);
                    $category->setIdentifier($index);
                    $category->setParentClass($parentClass);
                }
                $this->entityManager->persist($category);
                $this->entityManager->flush();
                $output->writeln('Saved '.$subCategory);
            }
        }


        $io->success('Imported Categories');
    }
}
