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
        }
        @endif

        @if(!empty($blogSettings->main_colors['font-color']))
            .custom-font-color {
            color: {{ $blogSettings->main_colors['font-color'] }}
        }
        @endif

    </style>
@endif
