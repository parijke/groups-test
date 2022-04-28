<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Group;
use App\Entity\Permission;
use App\Entity\Role;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\SubMenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
//        return $this->redirect($this->adminUrlGenerator->setController(ContactCrudController::class)->generateUrl());

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
         return $this->render('dashboard/dashboard.html.twig');
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->showEntityActionsInlined()
            ;
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(
                Crud::PAGE_INDEX,
                Action::DETAIL,
                static function (Action $action): \EasyCorp\Bundle\EasyAdminBundle\Config\Action {
                    return $action->setIcon('fa fa-eye')->setLabel(false);
                }
            )
            ->update(
                Crud::PAGE_INDEX,
                Action::EDIT,
                static function (Action $action): \EasyCorp\Bundle\EasyAdminBundle\Config\Action {
                    return $action->setIcon('fa fa-pencil')->setLabel(false);
                }
            )
            ->update(
                Crud::PAGE_INDEX,
                Action::DELETE,
                static function (Action $action): \EasyCorp\Bundle\EasyAdminBundle\Config\Action {
                    return $action->setIcon('fa fa-trash')->setLabel(false);
                }
            );
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Groups Test');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Contacts', 'fa fa-user', Contact::class);
        yield MenuItem::subMenu('Admin', 'fa fa-user-secret', 'Admin')

            ->setSubItems([
                MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
                MenuItem::linkToCrud('Groups', 'fa fa-users', Group::class),
                MenuItem::linkToCrud('Roles', 'fa fa-users', Role::class),
                MenuItem::linkToCrud('Permissions', 'fa fa-users', Permission::class),
            ]);
    }
}
