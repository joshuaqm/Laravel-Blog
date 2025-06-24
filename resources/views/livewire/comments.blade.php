<div>
    @if (count($comments))
        
        <div class="bg-white shadow rounded-lg p-6 dark:bg-neutral-700 mb-8">
            <ul>
                @foreach ($comments as $comment)
                <li class="mb-4">
                    {{ $comment }}:
                </li>                
                @endforeach
            </ul>
        </div>
    @endif
</div>
