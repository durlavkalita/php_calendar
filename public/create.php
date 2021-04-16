<?php

$pdo = require_once "../database.php";

$errors = [];
$name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once "../validation.php";

  if (empty($errors)) {
    $statement = $pdo->prepare("INSERT INTO events (name, date, time)
    VALUES (:name, :date, :time)");
    $statement->bindValue(':name', $name);
    $statement->bindValue(':date', $date);
    $statement->bindValue(':time', $time);
    $statement->execute();
    header('Location: /');
  }
}

?>

<?php require_once "../views/layout.php"; ?>
<div class="p-4 max-w-5xl mx-auto">
  <div class="mt-5 md:mt-0 md:col-span-2">
    <h1 class="text-2xl p-4">Create New Event</h1>
    <?php if(!empty($errors)): ?>
    <div>
      <?php foreach($errors as $error): ?>
      <div><?php echo $error ?></div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <form action="" method="post">
      <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <div class="grid grid-cols-3 gap-6">
            <div class="col-span-3 sm:col-span-2">
              <label for="name" class="block text-sm font-medium text-gray-700">
                Event Name
              </label>
              <div class="mt-1 flex rounded-md shadow-sm">
                <input type="text" name="name" id="name" class="p-2 border focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="event name" value="<?php echo $name ?>">
              </div>
            </div>
            <div class="col-span-3 sm:col-span-2">
              <label for="date" class="block text-sm font-medium text-gray-700">
                Date
              </label>
              <div class="mt-1 flex rounded-md shadow-sm">
                <input type="date" name="date" id="date" class="p-2 border focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
              </div>
            </div>
            <div class="col-span-3 sm:col-span-2">
              <label for="time" class="block text-sm font-medium text-gray-700">
                Time
              </label>
              <div class="mt-1 flex rounded-md shadow-sm">
                <input type="time" name="time" id="time" class="p-2 border focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
              </div>
            </div>
            <div class="col-span-3 sm:col-span-2">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>