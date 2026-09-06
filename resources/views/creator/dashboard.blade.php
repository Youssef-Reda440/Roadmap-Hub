<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creator Dashboard - Roadmap Studio</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/pages/styles.css"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-kanban-fill me-2"></i>Roadmap Studio
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" onclick="showView('dashboard')">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showView('my-roadmaps')">
                            <i class="bi bi-collection me-2"></i>My Roadmaps
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showView('add-roadmap')">
                            <i class="bi bi-plus-circle me-2"></i>Add Roadmap
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <div class="creator-profile">
                            <div class="creator-avatar" style="width: 40px; height: 40px; font-size: 1rem;">JD</div>
                            <div class="d-none d-lg-block">
                                <div class="fw-bold" style="font-size: 0.875rem;">John Doe</div>
                                <div style="font-size: 0.75rem; color: #64748b;">Creator</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-4 py-lg-5">

        <!-- DASHBOARD VIEW -->
        <div id="view-dashboard" class="view-section fade-in">
            <div class="page-header">
                <div class="creator-profile mb-4">
                    <div class="creator-avatar">JD</div>
                    <div>
                        <h1 class="page-title mb-1">Welcome back, John Doe!</h1>
                        <p class="page-subtitle mb-0">Here's what's happening with your roadmaps.</p>
                    </div>
                </div>
            </div>name

            <!-- Stats Row -->
            <div class="row g-4 mb-5">
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #e0e7ff; color: #4f46e5;">
                            <i class="bi bi-kanban"></i>
                        </div>
                        <div class="stat-value" id="stat-roadmaps">12</div>
                        <div class="stat-label">Total Roadmaps</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="stat-value" id="stat-reviews">48</div>
                        <div class="stat-label">Total Reviews</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #d1fae5; color: #059669;">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <div class="stat-value" id="stat-rating">4.8</div>
                        <div class="stat-label">Avg. Rating</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="stat-value" id="stat-learners">1.2k</div>
                        <div class="stat-label">Total Learners</div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Recent Roadmaps -->
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h4 fw-bold mb-0">Recent Roadmaps</h2>
                        <button class="btn btn-outline-custom btn-sm" onclick="showView('my-roadmaps')">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </div>
                    <div class="row g-4" id="dashboard-roadmaps">
                        <!-- Populated by JS -->
                    </div>
                </div>

                <!-- Recent Reviews -->
                <div class="col-lg-4">
                    <h2 class="h4 fw-bold mb-4">Recent Reviews</h2>
                    <div id="dashboard-reviews">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>
        </div>

        <!-- MY ROADMAPS VIEW -->
        <div id="view-my-roadmaps" class="view-section d-none fade-in">
            <div
                class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h1 class="page-title">My Roadmaps</h1>
                    <p class="page-subtitle mb-0">Manage and organize your learning roadmaps.</p>
                </div>
                <button class="btn btn-primary-custom" onclick="showView('add-roadmap')">
                    <i class="bi bi-plus-lg me-2"></i>Create Roadmap
                </button>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr>
                                    <th>Roadmap</th>
                                    <th class="d-none d-md-table-cell">Status</th>
                                    <th class="d-none d-lg-table-cell">Resources</th>
                                    <th class="d-none d-lg-table-cell">Created</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="roadmaps-table-body">
                                <!-- Populated by JS -->
                            </tbody>
                        </table>
                    </div>
                    <div id="roadmaps-empty" class="empty-state d-none">
                        <div class="empty-state-icon"><i class="bi bi-folder-open"></i></div>
                        <h3 class="h5 fw-bold">No roadmaps yet</h3>
                        <p>Create your first roadmap to get started.</p>
                        <button class="btn btn-primary-custom mt-2" onclick="showView('add-roadmap')">
                            <i class="bi bi-plus-lg me-2"></i>Create Roadmap
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADD/EDIT ROADMAP VIEW -->
        <div id="view-add-roadmap" class="view-section d-none fade-in">
            <div
                class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h1 class="page-title" id="form-title">Add New Roadmap</h1>
                    <p class="page-subtitle mb-0">Create a structured learning path for your audience.</p>
                </div>
                <button class="btn btn-outline-custom" onclick="showView('my-roadmaps')">
                    <i class="bi bi-arrow-left me-2"></i>Back to List
                </button>
            </div>

            <form id="roadmap-form" onsubmit="event.preventDefault(); saveRoadmap();">
                <input type="hidden" id="edit-id" value="">

                <!-- Basic Info -->
                <div class="form-section">
                    <h3 class="h5 fw-bold mb-4"><i class="bi bi-info-circle me-2 text-primary"></i>Basic Information
                    </h3>
                    <div class="row g-4">
                        <div class="col-md-8">
                            <label class="form-label">Roadmap Title</label>
                            <input type="text" class="form-control" id="rm-title"
                                placeholder="e.g., Full Stack Web Development" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select class="form-select" id="rm-category">
                                <option value="development">Development</option>
                                <option value="design">Design</option>
                                <option value="business">Business</option>
                                <option value="marketing">Marketing</option>
                                <option value="data">Data Science</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="rm-description" rows="4"
                                placeholder="Describe what learners will achieve..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="rm-status">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Resources Builder -->
                <div class="form-section">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="h5 fw-bold mb-0"><i class="bi bi-list-ol me-2 text-primary"></i>Learning Resources
                        </h3>
                        <span class="text-muted" style="font-size: 0.875rem;">Drag to reorder using arrows</span>
                    </div>

                    <div class="resource-builder-header text-center">
                        <p class="mb-2 fw-semibold">Build your learning path step by step</p>
                        <button type="button" class="btn btn-primary-custom btn-sm" onclick="addResource()">
                            <i class="bi bi-plus-lg me-1"></i>Add Resource
                        </button>
                    </div>

                    <div id="resources-container">
                        <!-- Resources populated here -->
                    </div>

                    <div id="resources-empty" class="empty-state py-4">
                        <div class="empty-state-icon" style="font-size: 3rem;"><i class="bi bi-collection"></i></div>
                        <p class="mb-0">No resources added yet. Click "Add Resource" to start building.</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-end">
                    <button type="button" class="btn btn-outline-custom"
                        onclick="showView('my-roadmaps')">Cancel</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="bi bi-check-lg me-2"></i>Save Roadmap
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Toast Notifications -->
    <div class="toast-container"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ==================== DATA STORE ====================
        let roadmaps = [{
                id: 1,
                title: "Full Stack Web Development",
                description: "Complete guide from HTML to deploying full-stack applications with Laravel and Vue.js.",
                category: "development",
                status: "published",
                created: "2024-01-15",
                resources: [{
                        type: "video",
                        title: "HTML & CSS Fundamentals",
                        url: "https://example.com/html-css",
                        description: "Learn the basics of web structure and styling",
                        order: 1
                    },
                    {
                        type: "documentation",
                        title: "Laravel Official Docs",
                        url: "https://laravel.com/docs",
                        description: "Comprehensive Laravel framework documentation",
                        order: 2
                    },
                    {
                        type: "website",
                        title: "MDN Web Docs",
                        url: "https://developer.mozilla.org",
                        description: "Mozilla's resources for web technologies",
                        order: 3
                    }
                ],
                reviews: 24,
                rating: 4.9
            },
            {
                id: 2,
                title: "UI/UX Design Masterclass",
                description: "Master design principles, Figma workflows, and user research methodologies.",
                category: "design",
                status: "published",
                created: "2024-02-20",
                resources: [{
                        type: "video",
                        title: "Design Principles",
                        url: "https://example.com/design",
                        description: "Core visual design fundamentals",
                        order: 1
                    },
                    {
                        type: "link",
                        title: "Dribbble Inspiration",
                        url: "https://dribbble.com",
                        description: "Daily design inspiration and showcases",
                        order: 2
                    }
                ],
                reviews: 18,
                rating: 4.7
            },
            {
                id: 3,
                title: "Digital Marketing Strategy",
                description: "Learn SEO, content marketing, social media strategies, and analytics.",
                category: "marketing",
                status: "draft",
                created: "2024-03-10",
                resources: [],
                reviews: 0,
                rating: 0
            }
        ];

        let reviews = [{
                id: 1,
                user: "Sarah Chen",
                avatar: "SC",
                rating: 5,
                text: "Amazing roadmap! The Laravel section saved me weeks of research.",
                roadmap: "Full Stack Web Development",
                date: "2 days ago"
            },
            {
                id: 2,
                user: "Mike Ross",
                avatar: "MR",
                rating: 5,
                text: "Very well structured. Love the resource ordering.",
                roadmap: "Full Stack Web Development",
                date: "5 days ago"
            },
            {
                id: 3,
                user: "Emily Watson",
                avatar: "EW",
                rating: 4,
                text: "Great content but would love more video resources.",
                roadmap: "UI/UX Design Masterclass",
                date: "1 week ago"
            },
            {
                id: 4,
                user: "David Kim",
                avatar: "DK",
                rating: 5,
                text: "Exactly what I needed to transition into design.",
                roadmap: "UI/UX Design Masterclass",
                date: "1 week ago"
            }
        ];

        let editingId = null;
        let tempResources = [];

        // ==================== VIEW ROUTING ====================
        function showView(viewName) {
            document.querySelectorAll('.view-section').forEach(el => el.classList.add('d-none'));
            document.getElementById('view-' + viewName).classList.remove('d-none');

            document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
            event?.target?.closest('.nav-link')?.classList.add('active');

            if (viewName === 'dashboard') renderDashboard();
            if (viewName === 'my-roadmaps') renderMyRoadmaps();
            if (viewName === 'add-roadmap') initAddForm();

            window.scrollTo(0, 0);
        }

        // ==================== DASHBOARD ====================
        function renderDashboard() {
            const container = document.getElementById('dashboard-roadmaps');
            const recent = roadmaps.slice(0, 3);

            container.innerHTML = recent.map(r => `
            <div class="col-md-6 col-xl-4">
                <div class="roadmap-card">
                    <div class="roadmap-header">
                        <span class="roadmap-status status-${r.status}">${r.status}</span>
                        <h3 class="h5 fw-bold mb-1">${r.title}</h3>
                        <p class="mb-0 opacity-75" style="font-size: 0.875rem;">${r.category}</p>
                    </div>
                    <div class="p-3">
                        <p class="text-muted mb-3" style="font-size: 0.875rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">${r.description}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted" style="font-size: 0.875rem;">
                                <i class="bi bi-collection me-1"></i>${r.resources.length} resources
                            </span>
                            <span class="text-warning" style="font-size: 0.875rem;">
                                <i class="bi bi-star-fill me-1"></i>${r.rating || 'N/A'}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');

            const reviewsContainer = document.getElementById('dashboard-reviews');
            reviewsContainer.innerHTML = reviews.slice(0, 4).map(r => `
            <div class="review-item">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="creator-avatar" style="width: 36px; height: 36px; font-size: 0.875rem;">${r.avatar}</div>
                        <div>
                            <div class="fw-bold" style="font-size: 0.875rem;">${r.user}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">${r.roadmap}</div>
                        </div>
                    </div>
                    <span class="text-muted" style="font-size: 0.75rem;">${r.date}</span>
                </div>
                <div class="review-stars mb-2">
                    ${Array(5).fill(0).map((_, i) => `<i class="bi bi-star${i < r.rating ? '-fill' : ''}"></i>`).join('')}
                </div>
                <p class="mb-0" style="font-size: 0.875rem; color: #475569;">"${r.text}"</p>
            </div>
        `).join('');

            // Update stats
            document.getElementById('stat-roadmaps').textContent = roadmaps.length;
            document.getElementById('stat-reviews').textContent = reviews.length;
            const avgRating = roadmaps.filter(r => r.rating > 0).reduce((a, b) => a + b.rating, 0) / roadmaps.filter(r => r
                .rating > 0).length || 0;
            document.getElementById('stat-rating').textContent = avgRating.toFixed(1);
        }

        // ==================== MY ROADMAPS ====================
        function renderMyRoadmaps() {
            const tbody = document.getElementById('roadmaps-table-body');
            const empty = document.getElementById('roadmaps-empty');

            if (roadmaps.length === 0) {
                tbody.innerHTML = '';
                empty.classList.remove('d-none');
                return;
            }

            empty.classList.add('d-none');
            tbody.innerHTML = roadmaps.map(r => `
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <div class="stat-icon" style="width: 40px; height: 40px; font-size: 1rem; margin: 0; background: ${r.status === 'published' ? '#d1fae5' : '#f1f5f9'}; color: ${r.status === 'published' ? '#059669' : '#64748b'};">
                                <i class="bi bi-kanban"></i>
                            </div>
                        </div>
                        <div>
                            <div class="fw-bold" style="color: #0f172a;">${r.title}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">${r.description.substring(0, 50)}...</div>
                        </div>
                    </div>
                </td>
                <td class="d-none d-md-table-cell">
                    <span class="badge ${r.status === 'published' ? 'bg-success' : 'bg-secondary'}">${r.status}</span>
                </td>
                <td class="d-none d-lg-table-cell text-muted">${r.resources.length}</td>
                <td class="d-none d-lg-table-cell text-muted" style="font-size: 0.875rem;">${r.created}</td>
                <td class="text-end">
                    <button class="action-btn btn-edit" onclick="editRoadmap(${r.id})" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="action-btn btn-delete" onclick="deleteRoadmap(${r.id})" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        `).join('');
        }

        function deleteRoadmap(id) {
            if (!confirm('Are you sure you want to delete this roadmap? This action cannot be undone.')) return;
            roadmaps = roadmaps.filter(r => r.id !== id);
            renderMyRoadmaps();
            showToast('Roadmap deleted successfully', 'danger');
        }

        // ==================== ADD/EDIT ROADMAP ====================
        function initAddForm() {
            editingId = null;
            document.getElementById('form-title').textContent = 'Add New Roadmap';
            document.getElementById('roadmap-form').reset();
            document.getElementById('edit-id').value = '';
            tempResources = [];
            renderResources();
        }

        function editRoadmap(id) {
            const roadmap = roadmaps.find(r => r.id === id);
            if (!roadmap) return;

            editingId = id;
            showView('add-roadmap');

            document.getElementById('form-title').textContent = 'Edit Roadmap';
            document.getElementById('edit-id').value = id;
            document.getElementById('rm-title').value = roadmap.title;
            document.getElementById('rm-description').value = roadmap.description;
            document.getElementById('rm-category').value = roadmap.category;
            document.getElementById('rm-status').value = roadmap.status;

            tempResources = JSON.parse(JSON.stringify(roadmap.resources));
            renderResources();
        }

        function addResource() {
            tempResources.push({
                type: 'video',
                title: '',
                url: '',
                description: '',
                order: tempResources.length + 1
            });
            renderResources();
        }

        function removeResource(index) {
            tempResources.splice(index, 1);
            tempResources.forEach((r, i) => r.order = i + 1);
            renderResources();
        }

        function moveResource(index, direction) {
            if (direction === -1 && index === 0) return;
            if (direction === 1 && index === tempResources.length - 1) return;

            const temp = tempResources[index];
            tempResources[index] = tempResources[index + direction];
            tempResources[index + direction] = temp;

            tempResources.forEach((r, i) => r.order = i + 1);
            renderResources();
        }

        function updateResourceField(index, field, value) {
            tempResources[index][field] = value;
        }

        function renderResources() {
            const container = document.getElementById('resources-container');
            const empty = document.getElementById('resources-empty');

            if (tempResources.length === 0) {
                container.innerHTML = '';
                empty.classList.remove('d-none');
                return;
            }

            empty.classList.add('d-none');
            container.innerHTML = tempResources.map((r, i) => `
            <div class="resource-item">
                <div class="row g-3 align-items-start">
                    <div class="col-auto">
                        <div class="d-flex flex-column align-items-center gap-2">
                            <div class="resource-order">${r.order}</div>
                            <div class="order-controls d-flex flex-column gap-1">
                                <button onclick="moveResource(${i}, -1)" ${i === 0 ? 'disabled' : ''} title="Move up">
                                    <i class="bi bi-chevron-up"></i>
                                </button>
                                <button onclick="moveResource(${i}, 1)" ${i === tempResources.length - 1 ? 'disabled' : ''} title="Move down">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label" style="font-size: 0.75rem;">Type</label>
                                <select class="form-select form-select-sm" onchange="updateResourceField(${i}, 'type', this.value)">
                                    <option value="video" ${r.type === 'video' ? 'selected' : ''}>Video</option>
                                    <option value="documentation" ${r.type === 'documentation' ? 'selected' : ''}>Documentation</option>
                                    <option value="website" ${r.type === 'website' ? 'selected' : ''}>Website</option>
                                    <option value="link" ${r.type === 'link' ? 'selected' : ''}>Link</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" style="font-size: 0.75rem;">Title</label>
                                <input type="text" class="form-control form-control-sm" value="${r.title}" onchange="updateResourceField(${i}, 'title', this.value)" placeholder="Resource title">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label" style="font-size: 0.75rem;">URL</label>
                                <input type="url" class="form-control form-control-sm" value="${r.url}" onchange="updateResourceField(${i}, 'url', this.value)" placeholder="https://...">
                            </div>
                            <div class="col-12">
                                <label class="form-label" style="font-size: 0.75rem;">Description</label>
                                <input type="text" class="form-control form-control-sm" value="${r.description}" onchange="updateResourceField(${i}, 'description', this.value)" placeholder="Brief description...">
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="action-btn btn-delete" onclick="removeResource(${i})" title="Remove resource">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
        }

        function saveRoadmap() {
            const title = document.getElementById('rm-title').value.trim();
            const description = document.getElementById('rm-description').value.trim();
            const category = document.getElementById('rm-category').value;
            const status = document.getElementById('rm-status').value;

            if (!title || !description) {
                showToast('Please fill in all required fields', 'warning');
                return;
            }

            if (editingId) {
                const idx = roadmaps.findIndex(r => r.id === editingId);
                if (idx !== -1) {
                    roadmaps[idx] = {
                        ...roadmaps[idx],
                        title,
                        description,
                        category,
                        status,
                        resources: [...tempResources]
                    };
                    showToast('Roadmap updated successfully!', 'success');
                }
            } else {
                const newRoadmap = {
                    id: Date.now(),
                    title,
                    description,
                    category,
                    status,
                    created: new Date().toISOString().split('T')[0],
                    resources: [...tempResources],
                    reviews: 0,
                    rating: 0
                };
                roadmaps.unshift(newRoadmap);
                showToast('Roadmap created successfully!', 'success');
            }

            showView('my-roadmaps');
        }

        // ==================== TOASTS ====================
        function showToast(message, type = 'success') {
            const container = document.querySelector('.toast-container');
            const toastId = 'toast-' + Date.now();
            const bgClass = type === 'success' ? 'bg-success' : type === 'danger' ? 'bg-danger' : 'bg-warning';
            const icon = type === 'success' ? 'check-circle' : type === 'danger' ? 'trash' : 'exclamation-triangle';

            const toastHtml = `
            <div id="${toastId}" class="toast align-items-center text-white ${bgClass} border-0" role="alert" style="min-width: 300px;">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-${icon} me-2"></i>${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `;

            container.insertAdjacentHTML('beforeend', toastHtml);
            const toastEl = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastEl, {
                delay: 3000
            });
            toast.show();

            toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
        }

        // ==================== INIT ====================
        document.addEventListener('DOMContentLoaded', () => {
            renderDashboard();
        });
    </script>

</body>

</html>
