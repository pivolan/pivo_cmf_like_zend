<p>id: {$blog.id}</p>
<p>author: {$blog.owner_id}</p>
<p>date create: {$blog.date_create|date_format:'%d.%m.%Y'}</p>
<div>
	{$blog.message}
</div>