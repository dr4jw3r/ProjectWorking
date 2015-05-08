<?php 
	require('../core/core_include.php');

	$lang['navigation'] = getTranslations('navigation');
	$lang['general'] = getTranslations('general');

	$page_title = 'LangExchange';
	$active_page = 'tour';

	require(PAGE_ELEMENTS_DIR . 'header.php');
?>
<section id="content" style="width:90%;margin: 0 auto;">
	<?php printSessionErrors(); printSessionSuccess(); ?>
	<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, commodi, quia. Deleniti debitis hic sapiente excepturi impedit voluptates cum vitae expedita. Sequi mollitia hic deleniti officia! Optio tempora cupiditate necessitatibus.</div>
	<div>Accusamus animi provident ipsa, alias veritatis voluptate non delectus reiciendis beatae modi assumenda odit autem, neque, a minima error amet magnam ab libero laboriosam magni eveniet quaerat. Natus, quaerat, expedita.</div>
	<div>Reprehenderit repellat consequuntur perferendis officia delectus, obcaecati beatae mollitia totam, ipsam, blanditiis necessitatibus. Incidunt rerum voluptate reprehenderit beatae atque eum aut consequuntur esse veniam accusantium, dolore nulla? Eligendi, quam ratione.</div>
	<div>Laborum molestias a quisquam corporis repudiandae consectetur optio officiis unde doloribus quibusdam earum deleniti harum autem quasi accusantium dignissimos delectus, recusandae aliquam reiciendis nam debitis dolorum, reprehenderit doloremque. Dolore, nesciunt.</div>
	<div>Ab delectus id provident, explicabo incidunt nulla fugit sit unde vero a tenetur doloribus deserunt recusandae similique saepe enim iste dignissimos voluptate sapiente omnis quo praesentium atque. Voluptate, eligendi, consectetur!</div>
	<div>Quidem numquam, culpa cumque, ipsam fuga tempore voluptate placeat beatae a nisi magnam debitis error facere, harum itaque? Repudiandae perferendis quae necessitatibus, beatae, debitis dolor cum quam fugiat rem maiores!</div>
	<div>Odio, ea ad dolore atque, laboriosam cumque eum, eligendi asperiores fugit quaerat assumenda modi alias! Voluptatem unde magnam quaerat incidunt dolorum hic modi recusandae, quo molestias numquam, officia, consequatur possimus.</div>
</section>
<?php
	require(PAGE_ELEMENTS_DIR . 'footer.php');
?>