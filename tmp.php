  $waiver = Waivermapping::where([
  ['feehead_id', $datesetup->feehead_id],
  ['student_id', $student_id],
  ['institute_id', $institute_id]
  ])->first();

  if (count($waiver) == 0) {
  $waiver_amount = 0;
  } else {
  $waiver_amount = $waiver->amount;
  $waiver_category = $waiver->waiver_category_id;
  }