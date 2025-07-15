# 🎤 What is this?

A simple PHP wrapper for [The0x539's KaraTemplater](https://github.com/The0x539/Aegisub-Scripts/blob/trunk/doc/0x.KaraTemplater.md), enabling you to write karaoke templates in **PHP** and export them as `.ass` subtitle files with ease.

# 🤔 Why?

I built this for one main reason: **to make my life easier**.

As someone who struggles with attention and focus, working directly in Aegisub's interface made it difficult to manage complex templates. Using **PHP**—the language I'm most comfortable with—gives me the power to:

* Reuse and organize components more cleanly 🧼
* Maintain complex effects in a scalable, readable way 🔁

# ⚙️ How does it work?

1. Create a PHP project (requires **PHP >= 8.4**)

2. Install the package via Composer:

   ```bash
   composer require rainbowrush/kara-templater
   ```

3. Create your templates as `.php` files and save them in a folder (e.g. `templates/`)

4. Convert your `.php` templates into `.ass` files:

   ```bash
   ./vendor/bin/kara-templater templates output
   ```

And that's it! 🎉

## 🧪 Example

```php
<?php

use RainbowRush\KaraTemplater\Core\KaraTemplater;
use RainbowRush\KaraTemplater\Core\Transform;

$karaTemplater = KaraTemplater::init('example');

$sfx = $karaTemplater->sfx('left to right syl effect');

$sfx->template()
    ->syl()
    ->retime('start2syl', '-300+(syl.i-1)*60')
    ->an(5)
    ->pos(expr('orgline.center'), expr('orgline.middle'))
    ->fade(300, 0);

$sfx->template()
    ->syl()
    ->retime("syl")
    ->an(5)
    ->pos(expr('orgline.center'), expr('orgline.middle'))
    ->transform(function (Transform $transform) {
        $transform->start(0)
            ->end(33)
            ->fscx(120)
            ->fscy(120);
    })
    ->transform(function (Transform $transform) {
        $transform->start(33)
            ->end(0)
            ->fscx(100)
            ->fscy(100);
    });

$sfx->template()
    ->syl()
    ->retime('end2syl', 0, '300-(#orgline.syls*60-syl.i*60)')
    ->an(5)
    ->pos(expr('orgline.center'), expr('orgline.middle'))
    ->fade(0, 300);

return $karaTemplater;
```

## 🧾 Output (`.ass` file content)

```ass
[Script Info]
Title: Default Aegisub file
ScriptType: v4.00+
WrapStyle: 0
ScaledBorderAndShadow: yes
YCbCr Matrix: None

[Aegisub Project Garbage]

[V4+ Styles]
Format: Name, Fontname, Fontsize, PrimaryColour, SecondaryColour, OutlineColour, BackColour, Bold, Italic, Underline, StrikeOut, ScaleX, ScaleY, Spacing, Angle, BorderStyle, Outline, Shadow, Alignment, MarginL, MarginR, MarginV, Encoding
Style: Default,Arial,48,&H00FFFFFF,&H000000FF,&H00000000,&H00000000,0,0,0,0,100,100,0,0,1,2,2,2,10,10,10,1

[Events]
Format: Layer, Start, End, Style, Name, MarginL, MarginR, MarginV, Effect, Text
Comment: 0,0:00:00.00,0:00:00.00,Default,,0,0,0,,[ ========== [SFX] left to right syl effect ========== ]
Comment: 0,0:00:00.00,0:00:00.00,Default,,0,0,0,,
Comment: 0,0:00:00.00,0:00:00.00,Default,,0,0,0,template syl,!retime("start2syl",-300+(syl.i-1)*60,0)!{\an5\pos(!orgline.center!,!orgline.middle!)\fade(300,0)}
Comment: 0,0:00:00.00,0:00:00.00,Default,,0,0,0,template syl,!retime("syl",0,0)!{\an5\pos(!orgline.center!,!orgline.middle!)\t(0,33,\fscx120\fscy120)\t(33,0,\fscx100\fscy100)}
Comment: 0,0:00:00.00,0:00:00.00,Default,,0,0,0,template syl,!retime("end2syl",0,300-(#orgline.syls*60-syl.i*60))!{\an5\pos(!orgline.center!,!orgline.middle!)\fade(0,300)}
Comment: 0,0:00:00.00,0:00:00.00,Default,,0,0,0,,
```
