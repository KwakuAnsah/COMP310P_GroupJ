<footer>
  &copy; <?php echo date('Y'); ?> MovieTime 
  <a href="<?php echo url_for('/about_us.php'); ?>">About Us</a> <- About us is here & needs styling
</footer>

</body>
</html>

<?php
    db_disconnnect($db);
?>