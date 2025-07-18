<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\ContactController;
use App\Controllers\KanbanController;
use App\Controllers\TaskController;
use App\Controllers\TeamController;
use App\Controllers\BoardController;
use Slim\App;

return function (App $app) {
    session_start();

    // ======================== HALAMAN UTAMA ========================
    $app->get('/', [HomeController::class, 'index']);

    // ======================== AUTH ================================
    $app->get('/login', [AuthController::class, 'showLoginForm']);
    $app->post('/login', [AuthController::class, 'login']);

    $app->get('/register', [AuthController::class, 'showRegisterForm']);
    $app->post('/register', [AuthController::class, 'register']);

    $app->get('/logout', [AuthController::class, 'logout']);

    // ======================== DASHBOARD ============================
    $app->get('/dashboard', [KanbanController::class, 'index']);

    // ======================== KONTAK ==============================
    $app->get('/contact', [ContactController::class, 'form']);         // ✅ tampilkan form kontak
    $app->post('/contact/submit', [ContactController::class, 'submit']); // ✅ proses kirim pesan

    // ======================== KANBAN ==============================
    $app->get('/kanban/create', [KanbanController::class, 'showCreateForm']);
    $app->post('/kanban/store', [KanbanController::class, 'store']);

    // ======================== TASKS ===============================
    $app->get('/tasks', [TaskController::class, 'index']);
    $app->get('/tasks/create', [TaskController::class, 'createForm']);
    $app->post('/tasks/create', [TaskController::class, 'store']);
    $app->get('/tasks/edit/{id}', [TaskController::class, 'editForm']);
    $app->post('/tasks/edit/{id}', [TaskController::class, 'update']);
    $app->get('/tasks/delete/{id}', [TaskController::class, 'delete']);
    $app->get('/tasks/detail/{id}', [TaskController::class, 'detail']);

    // ======================== TEAMS ===============================
    $app->get('/teams', [TeamController::class, 'index']);
    $app->get('/teams/create', [TeamController::class, 'createForm']);
    $app->post('/teams/create', [TeamController::class, 'store']);
    $app->get('/teams/edit/{id}', [TeamController::class, 'editForm']);
    $app->post('/teams/edit/{id}', [TeamController::class, 'update']);
    $app->get('/teams/delete/{id}', [TeamController::class, 'delete']);

    // Team Members
    $app->get('/teams/{id}/members', [TeamController::class, 'members']);
    $app->post('/teams/{id}/members/add', [TeamController::class, 'addMember']);
    $app->get('/teams/{id}/members/delete/{member_id}', [TeamController::class, 'deleteMember']);

    // ======================== BOARD ===============================
    $app->get('/boards', [BoardController::class, 'index']);
    $app->post('/boards/create', [BoardController::class, 'store']);
    $app->get('/boards/delete/{id}', [BoardController::class, 'delete']);

    // ======================== LIKE & COMMENT ======================
    $app->post('/kanban/like/{id}', [DashboardController::class, 'like']);
    $app->post('/kanban/comment/{id}', [DashboardController::class, 'comment']);
};
