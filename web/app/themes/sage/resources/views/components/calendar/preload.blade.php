{{--
  Static skeleton for x-calendar (no Alpine). Shown until JS sets data-js-hydrated="true" on the parent.
  Mirrors nav / caption / weekday / day grid layout to limit layout shift. See docs/components/js-preload.md.
  @var array<string, string> $c
  @var int $nMonths
  @var string $captionLayoutKey
--}}
<div
    class="shadpine-js-preload pointer-events-none select-none"
    aria-hidden="true"
    data-slot="calendar-preload"
>
    <div class="{{ $c['months'] }}">
        <nav class="{{ $c['nav'] }}" aria-hidden="true">
            <x-skeleton class="{{ $c['button_nav'] }} shrink-0" data-slot="calendar-preload-nav-prev" />
            <x-skeleton class="{{ $c['button_nav'] }} shrink-0" data-slot="calendar-preload-nav-next" />
        </nav>
        @for ($mi = 0; $mi < $nMonths; $mi++)
            <div class="{{ $c['month'] }}">
                @if ($mi === 0)
                    <div class="{{ $c['month_toolbar'] }}">
                        @if ($captionLayoutKey === 'dropdown')
                            <div class="{{ $c['month_caption'] }} flex flex-wrap items-center justify-center gap-1.5">
                                <x-skeleton
                                    class="h-7 min-w-[2.75rem] max-w-[4rem] shrink-0 rounded-md sm:max-w-[4.25rem]"
                                    data-slot="calendar-preload-caption-month"
                                />
                                <x-skeleton
                                    class="h-7 max-w-[3.25rem] shrink-0 rounded-md sm:max-w-[3.5rem]"
                                    data-slot="calendar-preload-caption-year"
                                />
                            </div>
                        @else
                            <div class="{{ $c['month_caption'] }} flex items-center justify-center">
                                <x-skeleton class="h-4 w-36 max-w-[80%] rounded-md" data-slot="calendar-preload-caption-label" />
                            </div>
                        @endif
                    </div>
                @endif
                @if ($mi > 0)
                    <div class="{{ $c['month_subcaption'] }} flex items-center justify-center">
                        <x-skeleton class="h-4 w-32 rounded-md" data-slot="calendar-preload-subcaption" />
                    </div>
                @endif
                <div class="{{ $c['grid'] }}" role="presentation">
                    <div class="{{ $c['weekdays_row'] }}">
                        @for ($wd = 0; $wd < 7; $wd++)
                            <div class="{{ $c['weekday'] }} flex items-center justify-center">
                                <x-skeleton class="mx-auto size-4 rounded-sm" data-slot="calendar-preload-weekday" />
                            </div>
                        @endfor
                    </div>
                    @for ($row = 0; $row < 6; $row++)
                        <div class="{{ $c['week_row'] }}">
                            @for ($col = 0; $col < 7; $col++)
                                <div class="{{ $c['day_td'] }} flex items-center justify-center">
                                    <x-skeleton
                                        class="aspect-square w-full min-w-(--cell-size) max-w-full rounded-(--cell-radius)"
                                        data-slot="calendar-preload-day"
                                    />
                                </div>
                            @endfor
                        </div>
                    @endfor
                </div>
            </div>
        @endfor
    </div>
</div>
