<?php
if (!defined('ABSPATH')) {
    exit;
}

global $cf_reward_points;
if (!$cf_reward_points) {
    return;
}

$user_id = get_current_user_id();
$points = $cf_reward_points->get_user_points($user_id);
$logs = $cf_reward_points->get_user_logs($user_id);
?>

<div class="bg-white p-6 rounded-lg border border-[#d4d4d4]">
    <h3 class="text-black-primary font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold mb-6 border-b border-[#d4d4d4] pb-3">Your Reward Balance</h3>
    
    <!-- <div class="bg-[#f9f9f9] flex flex-col items-center justify-center py-10 rounded-lg mb-8">
        <div class="text-[#010101] font-['Raleway-SemiBold',_sans-serif] text-[40px] leading-[44px] font-semibold mb-2"><?php echo esc_html($points); ?></div>
        <div class="text-[#2f2f2f] font-['Raleway-Regular',_sans-serif] text-sm opacity-80">Total Available Points</div>
        <div class="text-[#2f2f2f] font-['Raleway-Regular',_sans-serif] text-xs opacity-60 mt-2">1000 points = <?php echo wc_price(1); ?> discount at checkout!</div>
    </div> -->
    <div class="flex flex-wrap gap-6 items-center justify-start w-full max-w-full md:w-[1440px] m-auto relative">
      <div class="bg-[#f9f9f9] flex flex-col gap-6 items-center justify-start flex-1 h-[147px] relative overflow-hidden">
        <div class="flex flex-row gap-[111px] items-center justify-center self-stretch flex-1 relative">
          <div class="flex flex-col gap-1 items-center justify-start shrink-0 w-[476px] relative">
            <div class="text-[#010101] text-center font-['Raleway-SemiBold',_sans-serif] text-[40px] leading-[44px] font-semibold relative self-stretch">
              02
            </div>
            <div class="text-[#2f2f2f] text-center font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch" style="opacity: 0.8">
              Rewards Earned
            </div>
          </div>
        </div>
      </div>
      <div class="bg-[#f9f9f9] flex flex-col gap-6 items-center justify-start flex-1 h-[147px] relative overflow-hidden">
        <div class="flex flex-row gap-[111px] items-center justify-center self-stretch flex-1 relative">
          <div class="flex flex-col gap-1 items-center justify-start shrink-0 w-[476px] relative">
            <div class="text-[#010101] text-center font-['Raleway-SemiBold',_sans-serif] text-[40px] leading-[44px] font-semibold relative self-stretch">
              220
            </div>
            <div class="text-[#2f2f2f] text-center font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch" style="opacity: 0.8">
              Total Points Earned
            </div>
          </div>
        </div>
      </div>
    </div>

    <h3 class="text-black-primary font-['Raleway-SemiBold',_sans-serif] text-xl leading-8 font-semibold mb-4 border-b border-[#d4d4d4] pb-3">Reward History</h3>
    
    <?php if (!empty($logs)): ?>
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-3 pr-3 font-['Raleway-SemiBold',_sans-serif] text-[#141414] text-sm">Date</th>
                        <th class="p-3 font-['Raleway-SemiBold',_sans-serif] text-[#141414] text-sm">Description</th>
                        <th class="p-3 font-['Raleway-SemiBold',_sans-serif] text-[#141414] text-sm">Type</th>
                        <th class="py-3 pl-3 font-['Raleway-SemiBold',_sans-serif] text-right text-[#141414] text-sm">Points</th>
                    </tr>
                </thead>
                <tbody class="font-['Raleway-Medium',_sans-serif] text-sm">
                    <?php foreach ($logs as $log): ?>
                        <tr class="border-b border-[#f0f0f0] hover:bg-gray-50 transition-colors">
                            <td class="py-4 pr-3 text-[#3f3f3f]"><?php echo date_i18n(get_option('date_format'), strtotime($log->created_at)); ?></td>
                            <td class="p-4 text-[#3f3f3f]"><?php echo esc_html($log->description); ?></td>
                            <td class="p-4">
                                <span class="px-2 py-1 text-xs rounded-full <?php echo $log->type === 'earned' ? 'bg-green-100 text-green-800' : 'bg-[#fce4e4] text-[#d93025]'; ?>">
                                    <?php echo esc_html(ucfirst($log->type)); ?>
                                </span>
                            </td>
                            <td class="py-4 pl-3 text-right font-semibold <?php echo $log->type === 'earned' ? 'text-green-600' : 'text-[#d93025]'; ?>">
                                <?php echo $log->type === 'earned' ? '+' : '-'; ?><?php echo esc_html($log->points); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-[#3f3f3f] font-['Raleway-Medium',_sans-serif] text-sm pt-4 pb-8">No reward points history found.</p>
    <?php endif; ?>
</div>
