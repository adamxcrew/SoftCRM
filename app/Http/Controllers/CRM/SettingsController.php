<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsStoreRequest;
use App\Jobs\StoreSystemLogJob;
use App\Jobs\UpdateSettingsJob;
use App\Queries\SystemLogsQueries;
use App\Services\HelpersFncService;
use App\Services\SettingsService;
use App\Services\SystemLogService;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SettingsController
 *
 * Controller for handling settings-related operations in the CRM.
 */
class SettingsController extends Controller
{
    use DispatchesJobs;

    private HelpersFncService $helpersFncService;
    private SettingsService $settingsService;
    private SystemLogService $systemLogsService;

    /**
     * SettingsController constructor.
     *
     * @param HelpersFncService $helpersFncService
     * @param SettingsService $settingsService
     * @param SystemLogService $systemLogService
     */
    public function __construct(HelpersFncService $helpersFncService, SettingsService $settingsService, SystemLogService $systemLogService)
    {
        $this->middleware(self::MIDDLEWARE_AUTH);

        $this->helpersFncService = $helpersFncService;
        $this->settingsService = $settingsService;
        $this->systemLogsService = $systemLogService;
    }

    /**
     * List all settings and system logs with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function processListOfSettings(): \Illuminate\View\View
    {
        return view('crm.settings.index')->with([
            'settings' => $this->settingsService->loadAllSettings(),
            'logs' => $this->helpersFncService->formatAllSystemLogs(),
            'logsPaginate' => SystemLogsQueries::getPaginate()
        ]);
    }

    /**
     * Update settings based on the provided request.
     *
     * @param SettingsStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function processUpdateSettings(SettingsStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the incoming request using the SettingsStoreRequest
        $validatedData = $request->validated();

        // Dispatch the UpdateSettingsJob to update the settings
        $this->dispatchSync(new UpdateSettingsJob($validatedData));

        // Dispatch the StoreSystemLogJob to store the system log
        $this->dispatchSync(new StoreSystemLogJob('SettingsModel has been changed.', $this->systemLogsService::successCode, auth()->user()));

        // Redirect back with a success message
        return redirect()->back()->with('message_success', $this->getMessage('messages.settings_update'));
    }
}
