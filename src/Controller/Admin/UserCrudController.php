<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class UserCrudController extends AbstractCrudController
{
    public const BASE_PATH='images/avatars';
    public const UPLOAD_DIR='public/images/avatars';

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('pseudo'),
            EmailField::new('email'),
            TextField::new('password'),
            ChoiceField::new('roles')
                ->setChoices(array_combine(['ROLE_ADMIN', 'ROLE_MODERATOR', 'ROLE_USER'], ['ROLE_ADMIN', 'ROLE_MODERATOR', 'ROLE_USER']))
                ->allowMultipleChoices()
                ->renderExpanded(),
            ImageField::new('avatar')
                 ->setBasePath(self::BASE_PATH)
                 ->setUploadDir(self::UPLOAD_DIR),             
        ];
    }


     //Pour hasher le password
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $password = $this->hasher->hashPassword($entityInstance, 'test123');
        $entityInstance->setPassword($password);
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
    
}
