<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        $user = $this->getUser();
        
        // Redirect based on role
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_dashboard');
        } else {
            // All other roles (STAFF, etc.) go to staff dashboard
            return $this->redirectToRoute('staff_dashboard');
        }
    }

    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function adminDashboard(EntityManagerInterface $em): Response
    {
        // Get statistics for admin dashboard
        $totalUsers = $em->getRepository('App\Entity\User')->count([]);
        // Add more statistics as needed
        
        return $this->render('dashboard/admin.html.twig', [
            'totalUsers' => $totalUsers,
            'todaysOrders' => 0, // Add your logic
            'pendingOrders' => 0, // Add your logic
            'todaysRevenue' => '0.00', // Add your logic
            'activeUsers' => 1, // Add your logic
            'totalProducts' => 0, // Add your logic
            'lowStockItems' => 0, // Add your logic
            'todaysCustomers' => 0, // Add your logic
            'recentOrders' => [], // Add your logic
        ]);
    }

    #[Route('/staff/dashboard', name: 'staff_dashboard')]
    #[IsGranted('ROLE_STAFF')]
    public function staffDashboard(): Response
    {
        // Sample data for staff dashboard
        $todaysTasks = [
            [
                'description' => 'Check morning inventory',
                'completed' => true,
                'time' => '8:00 AM',
                'priority' => 'high'
            ],
            [
                'description' => 'Prepare coffee station',
                'completed' => true,
                'time' => '8:30 AM',
                'priority' => 'medium'
            ],
            [
                'description' => 'Update menu board',
                'completed' => false,
                'time' => '10:00 AM',
                'priority' => 'medium'
            ],
            [
                'description' => 'Clean tables',
                'completed' => false,
                'time' => '2:00 PM',
                'priority' => 'low'
            ],
        ];
        
        return $this->render('dashboard/staff.html.twig', [
            'ordersHandled' => 0, // Add your logic
            'totalSales' => '0.00', // Add your logic
            'pendingOrders' => 0, // Add your logic
            'tablesServed' => 0, // Add your logic
            'activeOrderCount' => 0, // Add your logic
            'activeOrders' => [], // Add your logic
            'todaysTasks' => $todaysTasks,
        ]);
    }
}