<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile | Academic Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FB] flex h-screen overflow-hidden text-gray-800">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col h-full flex-shrink-0">
        <div class="h-20 flex items-center px-6 border-b border-gray-100">
            <div class="bg-gray-900 text-white rounded-md p-2 mr-3 flex items-center justify-center">
                <i class="fa-solid fa-graduation-cap text-lg"></i>
            </div>
            <div>
                <h1 class="font-semibold text-gray-900 text-lg leading-tight">LavaLust</h1>
                <p class="text-sm text-gray-500 leading-tight">JhonasGwapo</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4">
            <div class="mb-6">
                <p class="text-xs font-semibold text-gray-400 mb-3 px-3 tracking-wider">MAIN MENU</p>
                <a href="<?= site_url('student'); ?>" class="flex items-center px-3 py-2.5 bg-gray-100 text-gray-900 rounded-lg mb-1 font-medium text-sm">
                    <i class="fa-solid fa-user-group w-5 mr-2"></i> Students
                </a>
                <a href="#" class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg mb-1 font-medium text-sm">
                    <i class="fa-solid fa-user-plus w-5 mr-2"></i> Add Student
                </a>
            </div>

            <div>
                <p class="text-xs font-semibold text-gray-400 mb-3 px-3 tracking-wider">TOOLS</p>
                <a href="#" class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg mb-1 font-medium text-sm">
                    <i class="fa-solid fa-chart-bar w-5 mr-2"></i> Reports
                </a>
                <a href="#" class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg mb-1 font-medium text-sm">
                    <i class="fa-solid fa-file-lines w-5 mr-2"></i> Transcripts
                </a>
                <a href="#" class="flex items-center px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg mb-1 font-medium text-sm">
                    <i class="fa-solid fa-gear w-5 mr-2"></i> Settings
                </a>
            </div>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden">
        
        <header class="bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center flex-shrink-0">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Student Profile</h2>
                <p class="text-gray-500 text-sm mt-1">Student Profile Overview</p>
            </div>
            <a href="<?= site_url('student'); ?>" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium flex items-center transition-colors shadow-sm">
                <i class="fa-solid fa-arrow-left mr-2"></i> Home
            </a>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-5xl mx-auto bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                
                <div class="p-8 border-b border-gray-100 flex items-center gap-6 bg-gray-50">
                    <div class="w-24 h-24 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-400 shadow-sm">
                        <i class="fa-regular fa-user text-4xl"></i>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-gray-900"><?= $name; ?></h3>
                        <p class="text-gray-600 mt-1 font-medium"><?= $course; ?></p>
                        <div class="flex items-center gap-3 mt-3">
                            <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Active</span>
                            <span class="text-sm text-gray-500"><i class="fa-regular fa-id-badge mr-1"></i> <?= $student_id; ?></span>
                        </div>
                    </div>
                </div>

                <div class="p-8 grid grid-cols-1 lg:grid-cols-2 gap-10">
                    
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 border-b border-gray-100 pb-2">Academic Information</h4>
                        <ul class="space-y-4 text-sm">
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-md transition-colors">
                                <span class="text-gray-500 font-medium">Student ID</span>
                                <span class="font-semibold text-gray-900"><?= $student_id; ?></span>
                            </li>
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-md transition-colors">
                                <span class="text-gray-500 font-medium">Year Level</span>
                                <span class="font-semibold text-gray-900"><?= $year; ?></span>
                            </li>
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-md transition-colors">
                                <span class="text-gray-500 font-medium">Course</span>
                                <span class="font-semibold text-gray-900"><?= $course; ?></span>
                            </li>
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-md transition-colors">
                                <span class="text-gray-500 font-medium">Section</span>
                                <span class="font-semibold text-gray-900"><?= $section; ?></span>
                            </li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 border-b border-gray-100 pb-2">Contact Information</h4>
                        <ul class="space-y-4 text-sm">
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-md transition-colors">
                                <span class="text-gray-500 font-medium">Email</span>
                                <span class="font-semibold text-gray-900"><?= $email; ?></span>
                            </li>
                            <li class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-md transition-colors">
                                <span class="text-gray-500 font-medium">Contact Number</span>
                                <span class="font-semibold text-gray-900"><?= $contact_number; ?></span>
                            </li>
                            <li class="flex justify-between items-start p-2 hover:bg-gray-50 rounded-md transition-colors">
                                <span class="text-gray-500 font-medium mt-0.5">Address</span>
                                <span class="font-semibold text-gray-900 text-right max-w-[200px]"><?= $address; ?></span>
                            </li>
                        </ul>
                    </div>

                    <div class="lg:col-span-2 mt-4 pt-6 border-t border-gray-100">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Additional Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                            <div class="bg-blue-50/50 p-5 rounded-lg border border-blue-100">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="fa-solid fa-laptop-code text-blue-500"></i>
                                    <span class="block font-bold text-blue-900">Skills</span>
                                </div>
                                <span class="font-medium text-gray-700 leading-relaxed"><?= $skills; ?></span>
                            </div>
                            
                            <div class="bg-purple-50/50 p-5 rounded-lg border border-purple-100">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="fa-solid fa-gamepad text-purple-500"></i>
                                    <span class="block font-bold text-purple-900">Hobbies</span>
                                </div>
                                <span class="font-medium text-gray-700 leading-relaxed"><?= $hobbies; ?></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</body>
</html>
