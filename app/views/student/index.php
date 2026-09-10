<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management | Academic Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-zinc-50 flex h-screen overflow-hidden text-zinc-800">

    <aside class="w-64 bg-white border-r border-zinc-200 flex flex-col h-full flex-shrink-0 z-10 relative shadow-[1px_0_10px_rgba(0,0,0,0.02)]">
        <div class="h-24 flex items-center px-8 border-b border-zinc-100">
            <div class="bg-black text-white rounded-none p-2.5 mr-4 flex items-center justify-center">
                <i class="fa-solid fa-graduation-cap text-lg"></i>
            </div>
            <div>
                <h1 class="font-bold text-zinc-900 text-lg tracking-tight leading-tight">LavaLust</h1>
                <p class="text-xs text-zinc-400 font-medium tracking-wide uppercase mt-0.5">JhonasGwapo</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-8 px-4">
            <div class="mb-8">
                <p class="text-[10px] font-bold text-zinc-400 mb-4 px-4 tracking-[0.2em] uppercase">Main Menu</p>
                <a href="<?= site_url('student'); ?>" class="flex items-center px-4 py-3 bg-zinc-50 text-black mb-1 font-semibold text-sm border-l-2 border-black">
                    <i class="fa-solid fa-user-group w-5 mr-3 text-zinc-800"></i> Students
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900 transition-colors duration-200 mb-1 font-medium text-sm border-l-2 border-transparent">
                    <i class="fa-solid fa-user-plus w-5 mr-3"></i> Add Student
                </a>
            </div>

            <div>
                <p class="text-[10px] font-bold text-zinc-400 mb-4 px-4 tracking-[0.2em] uppercase">Tools</p>
                <a href="#" class="flex items-center px-4 py-3 text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900 transition-colors duration-200 mb-1 font-medium text-sm border-l-2 border-transparent">
                    <i class="fa-solid fa-chart-bar w-5 mr-3"></i> Reports
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900 transition-colors duration-200 mb-1 font-medium text-sm border-l-2 border-transparent">
                    <i class="fa-solid fa-file-lines w-5 mr-3"></i> Transcripts
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900 transition-colors duration-200 mb-1 font-medium text-sm border-l-2 border-transparent">
                    <i class="fa-solid fa-gear w-5 mr-3"></i> Settings
                </a>
            </div>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-[#FAFAFA]">
        
        <header class="bg-white px-10 py-8 flex justify-between items-end flex-shrink-0 border-b border-zinc-200">
            <div>
                <h2 class="text-3xl font-bold text-zinc-900 tracking-tight">Student Management</h2>
                <p class="text-zinc-500 text-sm mt-2 font-medium">Manage student profiles and academic information</p>
            </div>
            <button class="bg-black hover:bg-zinc-800 text-white px-5 py-2.5 text-sm font-medium flex items-center transition-all duration-300 shadow-sm rounded-none">
                <i class="fa-solid fa-plus mr-2 text-xs"></i> Add Student
            </button>
        </header>

        <div class="px-10 py-5 flex items-center gap-4 flex-shrink-0 border-b border-zinc-100 bg-white">
            <div class="relative flex-1 max-w-xl">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-zinc-400 text-sm"></i>
                <input type="text" placeholder="Search students by name or ID..." class="w-full bg-zinc-50 border border-zinc-200 rounded-none pl-11 pr-4 py-2.5 text-sm focus:border-black focus:ring-0 outline-none transition-colors placeholder:text-zinc-400">
            </div>
            
            <div class="flex items-center gap-3 ml-auto">
                <div class="relative">
                    <select class="appearance-none bg-white border border-zinc-200 rounded-none pl-4 pr-10 py-2.5 text-sm text-zinc-700 outline-none cursor-pointer hover:border-zinc-300 transition-colors font-medium">
                        <option>All Grades</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-zinc-400 text-[10px] pointer-events-none"></i>
                </div>
                
                <div class="relative">
                    <select class="appearance-none bg-white border border-zinc-200 rounded-none pl-4 pr-10 py-2.5 text-sm text-zinc-700 outline-none cursor-pointer hover:border-zinc-300 transition-colors font-medium">
                        <option>All Status</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-zinc-400 text-[10px] pointer-events-none"></i>
                </div>

                <div class="flex border border-zinc-200 bg-zinc-50 ml-2 rounded-none p-0.5">
                    <button class="bg-white text-black px-3 py-1.5 shadow-[0_1px_2px_rgba(0,0,0,0.05)] transition-all"><i class="fa-solid fa-border-all w-4 h-4 text-center"></i></button>
                    <button class="text-zinc-400 hover:text-zinc-800 px-3 py-1.5 transition-all"><i class="fa-solid fa-list w-4 h-4 text-center"></i></button>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto p-10">
            <div class="mb-8 flex items-center justify-between">
                <span class="text-xs font-bold text-zinc-400 uppercase tracking-widest">Showing 1 of 1 students</span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                
                <div class="bg-white border border-zinc-200 p-7 hover:border-zinc-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all duration-300 flex flex-col h-full rounded-none group">
                    
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-zinc-50 border border-zinc-100 flex items-center justify-center text-zinc-400 rounded-full group-hover:scale-105 transition-transform duration-300">
                            <i class="fa-regular fa-user text-lg"></i>
                        </div>
                        <span class="bg-zinc-900 text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1">Active</span>
                    </div>
                    
                    <div class="mb-5">
                        <h3 class="font-bold text-zinc-900 text-xl tracking-tight truncate mb-1">
                            <?= htmlspecialchars($student['name']); ?>
                        </h3>
                        <p class="text-sm text-zinc-500 font-medium"><?= htmlspecialchars($student['course']); ?> &bull; <?= htmlspecialchars($student['year']); ?></p>
                    </div>
                    
                    <div class="space-y-3 mb-6 flex-1">
                        <div class="flex items-center text-sm text-zinc-600">
                            <i class="fa-solid fa-fingerprint w-5 text-zinc-300"></i>
                            <span class="font-medium tracking-wide"><?= htmlspecialchars($student['student_id']); ?></span>
                        </div>
                        <div class="flex items-center text-sm text-zinc-600">
                            <i class="fa-regular fa-envelope w-5 text-zinc-300"></i>
                            <span class="truncate"><?= htmlspecialchars($student['email']); ?></span>
                        </div>
                        <div class="flex items-center text-sm text-zinc-600">
                            <i class="fa-solid fa-layer-group w-5 text-zinc-300"></i>
                            <span>Section <?= htmlspecialchars($student['section']); ?></span>
                        </div>
                    </div>
                    
                    <div class="pt-5 border-t border-zinc-100 mt-auto">
                        <a href="<?= site_url('student/profile'); ?>" class="block w-full text-center border border-zinc-200 text-zinc-700 hover:bg-black hover:text-white hover:border-black font-semibold py-2.5 px-4 text-sm transition-colors duration-300 rounded-none">
                            View Profile
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>
