<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        </div>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2">Login</a>
                            <a href="{{ route('register') }}" class="ml-4 text-gray-600 hover:text-gray-900 px-3 py-2">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            <!-- Introduction Section -->
            <section class="bg-white py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">مرحباً بكم في موقعنا</h1>
                        <p class="text-xl text-gray-600 mb-8">
                            منصة متكاملة لإدارة الحملات والتبرعات لدعم القضايا الإنسانية والمشاريع الخيرية
                        </p>
                        @guest
                        <div class="space-x-4">
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                                إنشاء حساب
                            </a>
                            <a href="{{ route('login') }}" class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg hover:bg-blue-50">
                                تسجيل الدخول
                            </a>
                        </div>
                        @endguest
                    </div>
                </div>
            </section>

            <!-- Latest Campaigns Section -->
            <section class="py-12 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-bold text-gray-900 text-center mb-8">أحدث الحملات</h2>
                    
                    <!-- Campaigns Table -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">اسم الحملة</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الوصف</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Sample campaign data - will be replaced with dynamic data -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">حملة التعليم للجميع</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">توفير التعليم للأطفال المحتاجين في المناطق النائية</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">نشطة</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-01-15</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">حملة الصحة للجميع</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">توفير الرعاية الصحية الأساسية للمجتمعات المحتاجة</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">قيد التجهيز</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-01-10</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">حملة الغذاء الآمن</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">توزيع وجبات غذائية للأسر المحتاجة</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">مكتملة</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-12-20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @guest
                    <div class="text-center mt-8">
                        <p class="text-gray-600 mb-4">سجل الآن للمشاركة في الحملات والتبرع</p>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                            انضم إلينا الآن
                        </a>
                    </div>
                    @endguest
                </div>
            </section>
        </main>
    </div>
</body>
</html>
