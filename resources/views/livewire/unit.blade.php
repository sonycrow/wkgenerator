<div class="main-unit">
    <div @class([
        "block",
        "{$class}",
        "{$class}-{$unit['faction']}"
        ])
         data-unitid="{{ $unit['id'] }}"
         data-nameid="{{ $unit['nameid'] }}"
         data-toimage="{{ $images }}"
         data-download="{{ $download }}">

        <div @class(['name', "color-{$unit['faction']}", "color-{$unit['nameid']}"])>{{ Str::upper($unit['name']) }}</div>

        @if($unit['art'])
            <div class="art art-{{$unit['faction']}}" style="background-image: url('{{ Vite::asset('resources/art/' . $unit['art'] . ".jpg") }}')"></div>
        @endif

        @if($unit['steps'] >= 2)
            <div @class(['step2', "color-{$unit['faction']}", "color-{$unit['nameid']}"])>◆◆</div>
            @if($unit['steps'] >= 3)
                <div @class(['step3', "color-{$unit['faction']}", "color-{$unit['nameid']}"])>◆◆◆</div>
                @if($unit['steps'] >= 4)
                    <div @class(['step4', "color-{$unit['faction']}", "color-{$unit['nameid']}"])>◆◆◆◆</div>
                @endif
            @endif
        @endif

        @if(str_contains($unit['atk'], "+"))
            <div class="attack">{{ str_replace("+", "", Str::upper($unit['atk'])) }}<span class="plus">+</span></div>
        @else
            <div class="attack">{{ str_replace("+", "", Str::upper($unit['atk'])) }}</div>
        @endif

        <div class="cost">{{ $unit['cost'] }}</div>

        <div class="move">
            @if(!empty($unit['terrain']))
                <div class="value">{{ $unit['move'] }}</div>
                <div class="terrain terrain-{{ $unit['terrain'] }}"></div>
            @else
                <div class="value value-zero">{{ $unit['move'] }}</div>
            @endif
        </div>

        @if($tts)
            <div class="backunit unit-{{$unit['faction']}}"></div>
        @endif
    </div>

    <div id="unit-{{ $unit['id'] }}"></div>
</div>
