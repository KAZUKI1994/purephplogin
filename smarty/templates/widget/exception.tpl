{if $exception|default:null}
    <div class="alert alert-danger">
        <h4>
            <i class="icon fa fa-ban"></i>
            {$exception->getCode()|default:''}
        </h4>
        <p>{$exception->getMessage()|default:''}</p>
    </div>
{/if}