// var validMethods = ["blob_announce","blob_delete","blob_get","blob_list","blob_reflect_all","block_show","channel_list_mine","channel_new","claim_abandon","claim_list","claim_list_by_channel","claim_list_mine","claim_new_support","claim_send_to_address","claim_show","cli_test_command","commands","daemon_stop","file_delete","file_list","file_reflect","file_set_status","get","get_availability","help","peer_list","publish","report_bug","resolve","resolve_name","routing_table_get","settings_get","settings_set","status","stream_cost_estimate","transaction_list","transaction_show","utxo_list","version","wallet_balance","wallet_is_address_mine","wallet_list","wallet_new_address","wallet_prefill_addresses","wallet_public_key","wallet_send","wallet_unused_address"];

var validMethods = allMethods;//["version", "help", "commands", "command_list", "claim_list_mine"];
var lessonGoals = [{"method":"help"}, {"method":"help", "parameter":"--command"}];

function getFailedResponse() {
	return "Invalid input, try entering \"version\".";
}