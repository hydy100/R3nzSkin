## Running Examples

1. Open the project directory:

   `cd path/to/solvecaptcha-php`

2. Make sure dependencies are installed:

   `composer install`

3. Run any example file using PHP:

   ```bash
   php examples/recaptcha_v2.php
   ```

   Replace `recaptcha.php` with the name of the example you want to run.

   📝 Most examples require a valid API key. You can set it like this:

   ```php
   $solver = new \SolveCaptcha\SolveCaptcha('YOUR_API_KEY');
   ```

   or in some files:

   ```php
   $apiKey = 'YOUR_API_KEY';
   ```

   🔐 Don’t forget to replace `'YOUR_API_KEY'` with your actual SolveCaptcha API key.