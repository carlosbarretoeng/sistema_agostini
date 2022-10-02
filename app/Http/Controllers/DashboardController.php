<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    function index(){
        return $this->indexSuperAdmin();
    }

    function getCompanyInfos() {
        $company = Company::select(
            DB::raw("count(*) as 'value'"),
            DB::raw("(DATE_FORMAT(created_at, '%Y-%m')) as 'date'")
        )
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();

        $companyData = array_map(function($entry) {
            $out[$entry['date']] = $entry['value'];
            return $out;
        }, $company->toArray());

        $companyCount = array_sum(array_map(function($entry) {
            return array_sum($entry);
        }, $companyData));

        return [
            "label" => "Empresas",
            "value" => $companyCount,
            "chartData" => $companyData
        ];
    }

    function getUserInfos() {
        $user = User::select(
            DB::raw("count(*) as 'value'"),
            DB::raw("(DATE_FORMAT(created_at, '%Y-%m')) as 'date'")
        )
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();

        $userData = array_map(function($entry) {
            $out[$entry['date']] = $entry['value'];
            return $out;
        }, $user->toArray());

        $userCount = array_sum(array_map(function($entry) {
            return array_sum($entry);
        }, $userData));

        return [
            "label" => "Usuários",
            "value" => $userCount,
            "chartData" => $userData
        ];
    }

    function getProductInfos() {
        $products = Product::select(
            DB::raw("count(*) as 'value'"),
            DB::raw("(DATE_FORMAT(created_at, '%Y-%m')) as 'date'")
        )
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();

        $productsData = array_map(function($entry) {
            $out[$entry['date']] = $entry['value'];
            return $out;
        }, $products->toArray());

        $productsCount = array_sum(array_map(function($entry) {
            return array_sum($entry);
        }, $productsData));

        return [
            "label" => "Produtos",
            "value" => $productsCount,
            "chartData" => $productsData
        ];
    }

    function indexSuperAdmin () {
        $data = [
            "stats" => [
                /*$this->getCompanyInfos(),
                $this->getUserInfos(),
                $this->getProductInfos()*/
            ]
        ];
        return Inertia::render('Dashboard/Index', $data);
    }
}
