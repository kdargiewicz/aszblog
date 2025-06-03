@if(!empty($blogSettings->main_colors))
    @php
        if (!function_exists('adjustBrightness')) {
            function adjustBrightness($hex, $steps = 30) {
                $hex = str_replace('#', '', $hex);
                if (strlen($hex) === 3) {
                    $hex = $hex[0].$hex[0] . $hex[1].$hex[1] . $hex[2].$hex[2];
                }

                $r = max(0, min(255, hexdec(substr($hex, 0, 2)) + $steps));
                $g = max(0, min(255, hexdec(substr($hex, 2, 2)) + $steps));
                $b = max(0, min(255, hexdec(substr($hex, 4, 2)) + $steps));

                return sprintf("#%02x%02x%02x", $r, $g, $b);
            }
        }

        $baseColor = $blogSettings->main_colors['body'] ?? '#ffffff';
        $lighterColor = adjustBrightness($baseColor, 20);
    @endphp

    <style>
        @if(!empty($blogSettings->main_colors['topbar-footer']))
            .site-nav,
        .site-footer {
            background-color: {{ $blogSettings->main_colors['topbar-footer'] }}  !important;
        }

        @endif

        @if(!empty($blogSettings->main_colors['body']))
            body {
            background-color: {{ $baseColor }};

            .custom-user-color {
                background-color: {{ $lighterColor }};
                border-radius: 8px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
                overflow: hidden;
                background-clip: padding-box;
            }


            .custom-user-color-padding {
                padding: 10px;
            }

{{--            @php--}}
{{--//                $pattern = $blogSettings->main_colors['body_pattern'] ?? null;--}}
{{--                $patternColor = ($blogSettings->main_colors['body_pattern_color'] ?? '#ccc') . '80'; // 50% opacity--}}
{{--            @endphp--}}

{{--            @if($pattern)--}}
{{--                @switch($pattern)--}}
{{--                    @case('diagonal')--}}
{{--                        background-image: repeating-linear-gradient(45deg, {{ $patternColor }} 0px, {{ $patternColor }} 2px, transparent 2px, transparent 10px--}}
{{--                    );--}}
{{--                    @break--}}

{{--                    @case('dots')--}}
{{--                        background-image: radial-gradient({{ $patternColor }} 1px, transparent 1px--}}
{{--                    );--}}
{{--                    background-size: 20px 20px;--}}
{{--                    @break--}}

{{--                    @case('grid')--}}
{{--                        background-image: linear-gradient({{ $patternColor }} 1px, transparent 1px),--}}
{{--                                   linear-gradient(90deg, {{ $patternColor }} 1px, transparent 1px);--}}
{{--                                   background-size: 20px 20px;--}}
{{--                    @break--}}
{{--                @endswitch--}}
{{--            @endif--}}

        }
        @endif
    </style>
@endif
