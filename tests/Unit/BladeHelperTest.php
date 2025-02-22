<?php

namespace TTBooking\ViteManager\Tests\Unit;

use Illuminate\Support\Facades\Blade;
use TTBooking\ViteManager\Tests\TestCase;

class BladeHelperTest extends TestCase
{
    public function test_echos_are_compiled(): void
    {
        $this->assertSame('<?php echo app(\'vite\')->app()->toHtml(); ?>', Blade::compileString('@viteApp'));
        $this->assertSame('<?php echo app(\'vite\')->app()->toHtml(); ?>', Blade::compileString('@viteApp()'));
        $this->assertSame('<?php echo app(\'vite\')->app(\'app\')->toHtml(); ?>', Blade::compileString('@viteApp(\'app\')'));

        $this->assertSame(
            '<?php echo app(\'vite\')->app(\'app\')->withEntryPoints([\'entry\'], true)->toHtml(); ?>',
            Blade::compileString('@viteApp(\'app\', \'entry\')')
        );

        $this->assertSame(
            '<?php echo app(\'vite\')->app(\'app\')->withEntryPoints([\'entry1\', \'entry2\'], true)->toHtml(); ?>',
            Blade::compileString('@viteApp(\'app\', \'entry1\', \'entry2\')')
        );
    }
}
