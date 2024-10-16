<?php

namespace App\Controller\Admin;

use App\Entity\Poi;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\DashboardController as BackendDashboardController;
use App\Entity\RestaurantDetails;

class DashboardController extends BackendDashboardController
{


    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Panel do zarzadzania marketingiem');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Szama'),
            MenuItem::linkToCrud(
                'POI',
                'fa-regular fa-file-lines',
                Poi::class
            )->setController(PoiCrudController::class),
            MenuItem::linkToCrud(
                'Dane restauracji',
                'fa-regular fa-file-lines',
                RestaurantDetails::class
            )->setController(RestaurantDetailsCrudController::class),
             MenuItem::linkToCrud(
                'Kategorie i menu',
                'fa-regular fa-file-lines',
                RestaurantDetails::class
            )->setController(RestaurantDetails2CrudController::class),
            // MenuItem::linkToCrud(
            //     'Polecane produkty',
            //     'fa-regular fa-file-lines',
            //     FeaturedProducts::class
            // )->setController(FeaturedProductsCrudController::class),
            // MenuItem::linkToCrud(
            //     'Komunikaty na hurton',
            //     'fa-regular fa-file-lines',
            //     Inbox::class
            // )->setController(InboxCrudController::class),
            // MenuItem::linkToCrud(
            //     'Gazetka na hurton',
            //     'fa-regular fa-file-lines',
            //     NewsPaper::class
            // )->setController(MarketingNewsPaperCrudController::class),
            // MenuItem::linkToCrud(
            //     'Panel do kodow rabatowych',
            //     'fa-regular fa-file-lines',
            //     CouponRabate::class
            // )->setController(CouponRabateCrudController::class),
            // MenuItem::linkToCrud(
            //     'Panel do zarządania banerami w wyszukiwarce',
            //     'fa-regular fa-file-lines',
            //     BannerManagementSearch::class
            // )->setController(BannerManagementSearchCrudController::class),
            // MenuItem::linkToUrl(
            //     'Zaloguj sie do Wordpress',
            //     'fa-regular fa-file-lines',
            //     'https://marketing.hurton.pl/wp/wp-login.php'
            // )
        ];
    }
}
