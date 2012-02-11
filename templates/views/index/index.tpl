{extends 'default.tpl'}
{block "asd1" append} в конец{/block} <br>
{block "asd2" prepend}в начало {/block} <br>
{block "asd3"} тут начало {$smarty.block.parent} тут конец {/block} <br>
проверка
