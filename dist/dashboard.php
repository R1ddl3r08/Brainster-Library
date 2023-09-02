<?php
require_once('php/autoload.php');

if (!($_SESSION['loggedIn'] && $_SESSION['role'] == 'admin')) {
    echo "Access denied";
    die();
}

$query = new Database\Query();
$pendingReviews = $query->getReviews('pending');
$rejectedReviews = $query->getReviews('rejected');
$books = $query->getBooks();
$authors = $query->getAll('authors');
$categories = $query->getAll('categories');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="output.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-black p-9 fixed w-full z-40 top-0">
        <h1 class="text-yellow-400 uppercase text-4xl font-bold tracking-wider text-center"><a href="index.html">Brainster Library</a></h1>
        <button href="#" class="btn absolute top-10 right-10" id="loginBtn">Login</button>
        <button href="#" class="btn absolute top-10 right-10" id="logoutBtn">Logout</button>
        <a href="./dashboard.php" class="btn absolute top-10 right-40" id="dashboardBtn">Dashboard</a>
    </nav>
    <div class="w-11/12 mx-auto">
        <div class="mt-32">

            <div id="dashboard" class="w-1/2 mx-auto">
                <div class="mb-10 flex justify-between">
                    <button id="openPendingReviewsBtn" class="p-5 rounded bg-yellow-500 hover:bg-yellow-600">
                        <h2 class="text-3xl font-bold text-white">Pending reviews</h2>
                    </button>
                    <button id="openRejectedReviewsBtn" class="p-5 rounded bg-red-500 hover:bg-red-600">
                        <h2 class="text-3xl font-bold text-white">Rejected reviews</h2>
                    </button>
                </div>
                <div class="flex justify-between">
                    <button id="openBooksBtn" class="p-5 rounded bg-blue-500 hover:bg-blue-600">
                        <h2 class="text-3xl font-bold text-white">Books</h2>
                    </button>
                    <button id="openCategoriesBtn" class="p-5 rounded bg-green-500 hover:bg-green-600">
                        <h2 class="text-3xl font-bold text-white">Categories</h2>
                    </button>
                    <button id="openAuthorsBtn" class="p-5 rounded bg-red-700 hover:bg-red-800">
                        <h2 class="text-3xl font-bold text-white">Authors</h2>
                    </button>
                </div>
            </div>

            <div id="pendingReviewsContainer">
                <div class="flex mb-5">
                    <h2 class="text-2xl font-bold m-2 mr-10">Pending Reviews</h2>
                    <button class="btn goBackBtn">Back</button>
                </div>
                <table>
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pendingReviews as $review) : ?>
                            <tr class="border-t border-gray-200">
                                <td class="px-6 py-4"><?= $review['id'] ?></td>
                                <td class="px-6 py-4"><?= $review['username'] ?></td>
                                <td class="px-6 py-4"><?= $review['title'] ?></td>
                                <td class="px-6 py-4"><?= $review['comment'] ?></td>
                                <td class="px-6 py-4">
                                    <button class="bg-green-500 rounded text-white font-bold py-2 px-4 hover:bg-green-600 approveReviewBtn" data-review-id="<?= $review['id'] ?>">Approve</button>
                                    <button class="bg-red-500 rounded text-white font-bold py-2 px-4 hover:bg-red-700 rejectReviewBtn" data-review-id="<?= $review['id'] ?>">Reject</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="rejectedReviewsContainer">
                <div class="flex mb-5">
                    <h2 class="text-2xl font-bold m-2 mr-10">Rejected Reviews</h2>
                    <button class="btn goBackBtn">Back</button>
                </div>
                <table>
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rejectedReviews as $review) : ?>
                            <tr class="border-t border-gray-200">
                                <td class="px-6 py-4"><?= $review['id'] ?></td>
                                <td class="px-6 py-4"><?= $review['username'] ?></td>
                                <td class="px-6 py-4"><?= $review['title'] ?></td>
                                <td class="px-6 py-4"><?= $review['comment'] ?></td>
                                <td class="px-6 py-4">
                                    <button class="bg-green-500 rounded text-white font-bold py-2 px-4 hover:bg-green-600 approveReviewBtn" data-review-id="<?= $review['id'] ?>">Approve</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="booksCrudContainer" class="mt-5 hidden">
                <div class="flex mb-5">
                    <h2 class="text-2xl font-bold m-2 mr-10">Books</h2>
                    <button class="bg-blue-500 rounded text-white font-bold py-2 px-4 hover:bg-blue-400 mr-10" id="addBookBtn">Add a book</button>
                    <button class="btn goBackBtn">Back</button>
                </div>
                <div>
                    <table class="bg-white border rounded mt-2">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publication year</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number of pages</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($books as $book) : ?>
                                <tr class="border-t border-gray-200">
                                    <td class="px-6 py-4"><?= $book['id'] ?></td>
                                    <td class="px-6 py-4"><?= $book['title'] ?></td>
                                    <td class="px-6 py-4"><?= $book['first_name'] . ' ' . $book['last_name'] ?></td>
                                    <td class="px-6 py-4"><?= $book['publication_year'] ?></td>
                                    <td class="px-6 py-4"><?= $book['number_of_pages'] ?></td>
                                    <td class="px-6 py-4 w-6 overflow-x-scroll max-w-xs"><?= $book['image'] ?></td>
                                    <td class="px-6 py-4"><?= $book['category'] ?></td>
                                    <td class="px-6 py-4 flex space-x-2">
                                        <button class="bg-yellow-500 rounded text-white font-bold py-2 px-4 hover:bg-yellow-400 editBookBtn" data-book-id="<?= $book['id'] ?>">Edit</button>
                                        <button class="bg-red-500 rounded text-white font-bold py-2 px-4 hover:bg-red-400 deleteBookBtn" data-book-id="<?= $book['id'] ?>">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="authorsCrudContainer" class="mt-5 hidden">
                <div class="flex mb-5">
                    <h2 class="text-2xl font-bold m-2 mr-10">Authors</h2>
                    <button class="bg-blue-500 rounded text-white font-bold py-2 px-4 hover:bg-blue-400 mr-10" id="addAuthorBtn">Add an author</button>
                    <button class="btn goBackBtn">Back</button>
                </div>
                <div>
                    <table class="bg-white border rounded overflow-y-scroll mt-2">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Short bio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </thead>
                        <tbody>
                            <?php foreach($authors as $author) : ?>
                                <tr class="border-t border-gray-200">
                                    <td class="px-6 py-4"><?= $author['id'] ?></td>
                                    <td class="px-6 py-4"><?= $author['first_name'] ?></td>
                                    <td class="px-6 py-4"><?= $author['last_name']?></td>
                                    <td class="px-6 py-4 max-w-md"><?= $author['short_bio'] ?></td>
                                    <td class="px-6 py-4">
                                        <button class="bg-yellow-500 rounded text-white font-bold py-2 px-4 hover:bg-yellow-400 editAuthorBtn" data-author-id="<?= $author['id'] ?>">Edit</button>
                                        <button class="bg-red-500 rounded text-white font-bold py-2 px-4 hover:bg-red-400 deleteAuthorBtn" data-author-id="<?= $author['id'] ?>">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="categoriesCrudContainer" class="mt-5 hidden">
                <div class="flex mb-5">
                    <h2 class="text-2xl font-bold m-2 mr-10">Categories</h2>
                    <button class="bg-blue-500 rounded text-white font-bold py-2 px-4 hover:bg-blue-400 mr-10" id="addCategoryBtn">Add a category</button>
                    <button class="btn goBackBtn">Back</button>
                </div>
                <div>
                    <table class="bg-white border rounded overflow-y-scroll mt-2">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </thead>
                        <tbody>
                            <?php foreach($categories as $category) : ?>
                                <tr class="border-t border-gray-200">
                                    <td class="px-6 py-4"><?= $category['id'] ?></td>
                                    <td class="px-6 py-4"><?= $category['category'] ?></td>
                                    <td class="px-6 py-4">
                                        <button class="bg-yellow-500 rounded text-white font-bold py-2 px-4 hover:bg-yellow-400 editCategoryBtn" data-category-id="<?= $category['id'] ?>">Edit</button>
                                        <button class="bg-red-500 rounded text-white font-bold py-2 px-4 hover:bg-red-400 deleteCategoryBtn" data-category-id="<?= $category['id'] ?>">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-overlay hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="logoutModal">
        <div class="bg-white p-8 rounded-lg w-2/5">
            <h2 class="text-xl font-bold mb-5">Are you sure you want to log out?</h2>
            <form action="" id="logoutForm">
                <button class="btn" type="submit">Logout</button>
                <button class="ml-2 text-gray-600" id="closeLogoutModal" type="button">Close</button>
            </form>
        </div>
    </div>

    <!-- Book modal  -->
    <div class="modal-overlay hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="booksCrudModal">
        <div class="bg-white p-8 rounded-lg w-2/5">
            <h2 class="text-2xl font-bold mb-4" id="booksModalTitle"></h2>
            <form id="addBookForm" class="hidden">
                <span class="text-red-700 font-semibold hidden" id="addBookErrorMessage">All fields are required</span>
                <div class="form-group">
                    <input type="text" placeholder="Title" class="form-control" name="title">
                    <span id="titleError" class="errorMessage text-red-700 font-semibold"></span>
                </div>
                <div class="form-group">
                    <select name="author" class="form-control">
                        <option value="0">Select author</option>
                        <?php foreach($authors as $author) : ?>
                            <option value="<?= $author['id'] ?>"><?= $author['first_name'] . ' ' . $author['last_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" placeholder="Publication year" class="form-control" name="publicationYear">
                </div>
                <div class="form-group">
                    <input type="number" placeholder="Number of pages" class="form-control" name="numberOfPages">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Image" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <select name="category" class="form-control">
                        <option value="0">Select category</option>
                        <?php foreach($categories as $category) : ?>
                            <option value="<?= $category['id'] ?>"><?= $category['category'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn" type="submit">Submit</button>
                <button class="ml-2 text-gray-600 closeBooksCrudModal" type="button">Close</button>
            </form>
            <form id="editBookForm" class="hidden">
                <span class="text-red-700 font-semibold hidden" id="editBookErrorMessage">All fields are required</span>
                <div class="form-group">
                    <input type="text" placeholder="Title" class="form-control" name="title">
                    <span id="titleError" class="errorMessage text-red-700 font-semibold"></span>
                </div>
                <div class="form-group">
                    <select name="author" class="form-control">
                        <option value="0">Select author</option>
                        <?php foreach($authors as $author) : ?>
                            <option value="<?= $author['id'] ?>"><?= $author['first_name'] . ' ' . $author['last_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" placeholder="Publication year" class="form-control" name="publicationYear">
                </div>
                <div class="form-group">
                    <input type="number" placeholder="Number of pages" class="form-control" name="numberOfPages">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Image" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <select name="category" class="form-control">
                        <option value="0">Select category</option>
                        <?php foreach($categories as $category) : ?>
                            <option value="<?= $category['id'] ?>"><?= $category['category'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="text" name="bookId" hidden>
                <button class="btn" type="submit">Submit</button>
                <button class="ml-2 text-gray-600 closeBooksCrudModal" type="button">Close</button>
            </form>
        </div>
    </div>

    <!-- Categories modal -->
    <div class="modal-overlay hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="categoriesCrudModal">
        <div class="bg-white p-8 rounded-lg w-2/5">
            <h2 class="text-2xl font-bold mb-4" id="categoriesModalTitle"></h2>
            <form id="addCategoryForm" class="hidden">
                <span class="text-red-700 font-semibold hidden" id="addCategoriesErrorMessage">All fields are required</span>
                <div class="form-group">
                    <input type="text" placeholder="Category name" class="form-control" name="category">
                </div>
                <button class="btn" type="submit">Submit</button>
                <button class="ml-2 text-gray-600 closeCategoriesCrudModal" type="button">Close</button>
            </form>
            <form id="editCategoryForm" class="hidden">
                <span class="text-red-700 font-semibold hidden" id="editCategoriesErrorMessage">All fields are required</span>
                <div class="form-group">
                    <input type="text" class="form-control" name="category">
                    <span id="titleError" class="errorMessage text-red-700 font-semibold"></span>
                    <input type="text" name="categoryId" hidden>
                </div>
                <button class="btn" type="submit">Submit</button>
                <button class="ml-2 text-gray-600 closeCategoriesCrudModal" type="button">Close</button>
            </form>
        </div>
    </div>

    <!-- Authors modal  -->
    <div class="modal-overlay hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="authorsCrudModal">
        <div class="bg-white p-8 rounded-lg w-2/5">
            <h2 class="text-2xl font-bold mb-4" id="authorsCrudModalTitle"></h2>
            <form id="addAuthorForm" class="hidden">
                <span class="text-red-700 font-semibold hidden" id="addAuthorErrorMessage">All fields are required</span>
                <div class="form-group">
                    <input type="text" placeholder="First Name" class="form-control" name="firstName">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Last Name" class="form-control" name="lastName">
                </div>
                <div class="form-group">
                    <textarea name="shortBio" placeholder="Short Bio" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <button class="btn" type="submit">Submit</button>
                <button class="ml-2 text-gray-600 closeAuthorsCrudModal" type="button">Close</button>
            </form>
            <form id="editAuthorForm" class="hidden">
                <span class="text-red-700 font-semibold hidden" id="editAuthorErrorMessage">All fields are required</span>
                <div class="form-group">
                    <input type="text" placeholder="First Name" class="form-control" name="firstName">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Last Name" class="form-control" name="lastName">
                </div>
                <div class="form-group">
                    <textarea name="shortBio" placeholder="Short Bio" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <input type="text" name="authorId" hidden>
                <button class="btn" type="submit">Submit</button>
                <button class="ml-2 text-gray-600 closeAuthorsCrudModal" type="button">Close</button>
            </form>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/login.js"></script>
    <script src="./js/crudModal.js"></script>
    <script src="./js/dashboardHashchange.js"></script>
    <script src="./js/changeReviewStatus.js"></script>
</body>
</html>
