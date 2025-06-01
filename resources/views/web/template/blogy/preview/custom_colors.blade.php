@if(!empty($blogSettings->main_colors['body']))
    <style>
        body {
            background-color: {{ $blogSettings->main_colors['body'] }};
            @if(!empty($blogSettings->main_colors['body_pattern']))
                background-image:
                @switch($blogSettings->main_colors['body_pattern'])
                    @case('diagonal')
repeating-linear-gradient(
                    45deg,
                                {{ $blogSettings->main_colors['body_pattern_color'] ?? '#ccc' }}80 0px,
                                {{ $blogSettings->main_colors['body_pattern_color'] ?? '#ccc' }}80 2px,
                    transparent 2px,
                    transparent 10px
                );
        @break

    @case('dots')
radial-gradient(
        {{ $blogSettings->main_colors['body_pattern_color'] ?? '#ccc' }}80 1px,
        transparent 1px
        );
            background-size: 20px 20px;
        @break

    @case('grid')
linear-gradient(
        {{ $blogSettings->main_colors['body_pattern_color'] ?? '#ccc' }}80 1px,
        transparent 1px
        ),
        linear-gradient(
        90deg,
        {{ $blogSettings->main_colors['body_pattern_color'] ?? '#ccc' }}80 1px,
        transparent 1px
        );
            background-size: 20px 20px;
        @break
@endswitch
@endif
}
    </style>
@endif
