<?php include('partials/menu.php'); ?>

<!-- start dashboard -->
<section class="max-w-4xl mx-auto mt-5">
  <?php 
        if(isset($_SESSION['login'])) {
          echo $_SESSION['login'];
          unset($_SESSION['login']);
        }
  ?>
</section>
<div class="">
  <div class="container mx-auto py-20 lg:px-12 sm:px-5">
    <h1 class="text-2xl font-bold capitalize mb-5">Dashboard</h1>
    <div class="grid lg:grid-cols-3 gap-6">

      <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
          <?php
              $sql = "SELECT * FROM category";
              $res = mysqli_query($conn, $sql);
              $count = mysqli_num_rows($res);
          ?>
          <div class="p-5">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                  Categories
              </h5>
              <p class="mb-3 font-normal text-gray-700">
                  total number of categories.
              </p>
              <p class="mb-3 font-normal text-gray-700">
                  <?php echo $count; ?>
              </p>
              <a href="manage-category.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                View more
                <svg
                  aria-hidden="true"
                  class="w-4 h-4 ml-2 -mr-1"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </a>
          </div>
      </div>

      <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
          <?php
              $sql2 = "SELECT * FROM food";
              $res2 = mysqli_query($conn, $sql2);
              $count2 = mysqli_num_rows($res2);
          ?>
          <div class="p-5">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                  Foods
              </h5>
              <p class="mb-3 font-normal text-gray-700">
                  total number of foods.
              </p>
              <p class="mb-3 font-normal text-gray-700">
                  <?php echo $count2; ?>
              </p>
              <a href="manage-food.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                View more
                <svg
                  aria-hidden="true"
                  class="w-4 h-4 ml-2 -mr-1"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </a>
          </div>
      </div>

      <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
          <?php
              $sql3 = "SELECT * FROM invoice";
              $res3 = mysqli_query($conn, $sql3);
              $count3 = mysqli_num_rows($res3);
          ?>
          <div class="p-5">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                  Orders
              </h5>
              <p class="mb-3 font-normal text-gray-700">
                  total number of orders.
              </p>
              <p class="mb-3 font-normal text-gray-700">
                  <?php echo $count3; ?>
              </p>
              <a href="manage-order.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                View more
                <svg
                  aria-hidden="true"
                  class="w-4 h-4 ml-2 -mr-1"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </a>
          </div>
      </div>

      <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
          <?php
              $sql4 = "SELECT SUM(net_total) AS Total FROM invoice";
              $res4 = mysqli_query($conn, $sql4);
              $row4 = mysqli_fetch_assoc($res4);
              $total_revenue = $row4['Total'];
          ?>
          <div class="p-5">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                  Revenue Generated
              </h5>
              <p class="mb-3 font-normal text-gray-700">
                  total revenue generated.
              </p>
              <p class="mb-3 font-normal text-gray-700">
                  <?php echo (!$total_revenue) ? ('0') : ($total_revenue); ?>
              </p>
              <a href="manage-order.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                View more
                <svg
                  aria-hidden="true"
                  class="w-4 h-4 ml-2 -mr-1"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </a>
          </div>
      </div>

        </div>
    </div>
</div>
<!-- end dashboard -->

<?php include('partials/footer.php') ?>