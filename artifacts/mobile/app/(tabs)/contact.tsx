import React, { useState } from 'react';
import {
  ActivityIndicator,
  Platform,
  Pressable,
  ScrollView,
  StyleSheet,
  Text,
  TextInput,
  View,
  Alert,
} from 'react-native';
import { useColors } from '@/hooks/useColors';
import { useSubmitContact, useListServices } from '@workspace/api-client-react';
import { Feather, Ionicons } from '@expo/vector-icons';
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import { KeyboardAwareScrollView } from 'react-native-keyboard-controller';
import * as Haptics from 'expo-haptics';

const BUDGET_OPTIONS = [
  'Under $1,000/mo',
  '$1,000 – $3,000/mo',
  '$3,000 – $5,000/mo',
  '$5,000+/mo',
];

function FormField({
  label,
  required,
  children,
  error,
}: {
  label: string;
  required?: boolean;
  children: React.ReactNode;
  error?: string;
}) {
  const colors = useColors();
  return (
    <View style={styles.formField}>
      <Text style={[styles.label, { color: colors.foreground }]}>
        {label}
        {required && <Text style={{ color: colors.accent }}> *</Text>}
      </Text>
      {children}
      {error ? <Text style={[styles.errorMsg, { color: colors.destructive }]}>{error}</Text> : null}
    </View>
  );
}

export default function ContactScreen() {
  const colors = useColors();
  const insets = useSafeAreaInsets();
  const topPad = Platform.OS === 'web' ? 67 : insets.top;
  const bottomPad = Platform.OS === 'web' ? 34 : insets.bottom + 60;

  const [form, setForm] = useState({
    name: '',
    email: '',
    phone: '',
    company: '',
    service: '',
    message: '',
    budget: '',
  });
  const [errors, setErrors] = useState<Record<string, string>>({});
  const [submitted, setSubmitted] = useState(false);

  const { data: services } = useListServices();
  const { mutate: submitContact, isPending } = useSubmitContact();

  const validate = () => {
    const newErrors: Record<string, string> = {};
    if (!form.name.trim() || form.name.trim().length < 2)
      newErrors.name = 'Name must be at least 2 characters';
    if (!form.email.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email))
      newErrors.email = 'Enter a valid email address';
    if (!form.message.trim() || form.message.trim().length < 10)
      newErrors.message = 'Message must be at least 10 characters';
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = () => {
    if (!validate()) {
      Haptics.notificationAsync(Haptics.NotificationFeedbackType.Error);
      return;
    }
    submitContact(
      {
        data: {
          name: form.name.trim(),
          email: form.email.trim(),
          phone: form.phone.trim() || null,
          company: form.company.trim() || null,
          service: form.service || null,
          message: form.message.trim(),
          budget: form.budget || null,
        },
      },
      {
        onSuccess: () => {
          Haptics.notificationAsync(Haptics.NotificationFeedbackType.Success);
          setSubmitted(true);
        },
        onError: () => {
          Haptics.notificationAsync(Haptics.NotificationFeedbackType.Error);
          Alert.alert('Error', 'Failed to send your request. Please try again.');
        },
      },
    );
  };

  const inputStyle = [
    styles.input,
    {
      backgroundColor: colors.input,
      borderColor: colors.border,
      color: colors.foreground,
    },
  ];

  if (submitted) {
    return (
      <View style={[styles.container, styles.successContainer, { backgroundColor: colors.background }]}>
        <View style={[styles.successIcon, { backgroundColor: '#0C1F3A' }]}>
          <Ionicons name="checkmark-circle" size={48} color={colors.primary} />
        </View>
        <Text style={[styles.successTitle, { color: colors.foreground }]}>Request Sent!</Text>
        <Text style={[styles.successSubtitle, { color: colors.mutedForeground }]}>
          Our team will review your details and get back to you within 24 hours.
        </Text>
        <Pressable
          style={({ pressed }) => [
            styles.submitBtn,
            { backgroundColor: colors.primary, opacity: pressed ? 0.85 : 1 },
          ]}
          onPress={() => {
            setSubmitted(false);
            setForm({ name: '', email: '', phone: '', company: '', service: '', message: '', budget: '' });
            setErrors({});
          }}
        >
          <Text style={[styles.submitText, { color: colors.primaryForeground }]}>
            Send Another Request
          </Text>
        </Pressable>
      </View>
    );
  }

  return (
    <View style={[styles.container, { backgroundColor: colors.background }]}>
      <View style={[styles.header, { paddingTop: topPad + 12, borderBottomColor: colors.border }]}>
        <Text style={[styles.headerTitle, { color: colors.foreground }]}>Free Audit</Text>
        <Text style={[styles.headerSubtitle, { color: colors.mutedForeground }]}>
          Tell us about your project
        </Text>
      </View>

      <KeyboardAwareScrollView
        style={{ flex: 1 }}
        contentContainerStyle={[styles.formContent, { paddingBottom: bottomPad }]}
        keyboardShouldPersistTaps="handled"
        bottomOffset={16}
        showsVerticalScrollIndicator={false}
      >
        <FormField label="Full Name" required error={errors.name}>
          <TextInput
            style={[inputStyle, errors.name ? { borderColor: colors.destructive } : null]}
            placeholder="John Smith"
            placeholderTextColor={colors.mutedForeground}
            value={form.name}
            onChangeText={(v) => setForm((f) => ({ ...f, name: v }))}
            autoCapitalize="words"
            returnKeyType="next"
          />
        </FormField>

        <FormField label="Email Address" required error={errors.email}>
          <TextInput
            style={[inputStyle, errors.email ? { borderColor: colors.destructive } : null]}
            placeholder="john@company.com"
            placeholderTextColor={colors.mutedForeground}
            value={form.email}
            onChangeText={(v) => setForm((f) => ({ ...f, email: v }))}
            keyboardType="email-address"
            autoCapitalize="none"
            returnKeyType="next"
          />
        </FormField>

        <View style={styles.row}>
          <View style={styles.halfField}>
            <FormField label="Phone">
              <TextInput
                style={inputStyle}
                placeholder="+971 50..."
                placeholderTextColor={colors.mutedForeground}
                value={form.phone}
                onChangeText={(v) => setForm((f) => ({ ...f, phone: v }))}
                keyboardType="phone-pad"
                returnKeyType="next"
              />
            </FormField>
          </View>
          <View style={styles.halfField}>
            <FormField label="Company">
              <TextInput
                style={inputStyle}
                placeholder="Acme Inc."
                placeholderTextColor={colors.mutedForeground}
                value={form.company}
                onChangeText={(v) => setForm((f) => ({ ...f, company: v }))}
                returnKeyType="next"
              />
            </FormField>
          </View>
        </View>

        {/* Service picker */}
        <FormField label="Service Interested In">
          <ScrollView
            horizontal
            showsHorizontalScrollIndicator={false}
            contentContainerStyle={styles.chipRow}
          >
            {(services ?? []).map((s) => (
              <Pressable
                key={s.slug}
                style={({ pressed }) => [
                  styles.chip,
                  {
                    backgroundColor:
                      form.service === s.title ? colors.primary : colors.secondary,
                    borderColor:
                      form.service === s.title ? colors.primary : colors.border,
                    opacity: pressed ? 0.8 : 1,
                  },
                ]}
                onPress={() => {
                  Haptics.selectionAsync();
                  setForm((f) => ({ ...f, service: f.service === s.title ? '' : s.title }));
                }}
              >
                <Text
                  style={[
                    styles.chipText,
                    {
                      color: form.service === s.title ? colors.primaryForeground : colors.mutedForeground,
                    },
                  ]}
                >
                  {s.title}
                </Text>
              </Pressable>
            ))}
          </ScrollView>
        </FormField>

        {/* Budget picker */}
        <FormField label="Monthly Budget">
          <View style={styles.budgetGrid}>
            {BUDGET_OPTIONS.map((b) => (
              <Pressable
                key={b}
                style={({ pressed }) => [
                  styles.budgetOption,
                  {
                    backgroundColor: form.budget === b ? colors.primary : colors.secondary,
                    borderColor: form.budget === b ? colors.primary : colors.border,
                    opacity: pressed ? 0.8 : 1,
                  },
                ]}
                onPress={() => {
                  Haptics.selectionAsync();
                  setForm((f) => ({ ...f, budget: f.budget === b ? '' : b }));
                }}
              >
                <Text
                  style={[
                    styles.budgetText,
                    {
                      color: form.budget === b ? colors.primaryForeground : colors.mutedForeground,
                    },
                  ]}
                >
                  {b}
                </Text>
              </Pressable>
            ))}
          </View>
        </FormField>

        <FormField label="Message" required error={errors.message}>
          <TextInput
            style={[
              inputStyle,
              styles.textArea,
              errors.message ? { borderColor: colors.destructive } : null,
            ]}
            placeholder="Tell us about your website, current rankings, and goals..."
            placeholderTextColor={colors.mutedForeground}
            value={form.message}
            onChangeText={(v) => setForm((f) => ({ ...f, message: v }))}
            multiline
            numberOfLines={5}
            textAlignVertical="top"
          />
        </FormField>

        <Pressable
          style={({ pressed }) => [
            styles.submitBtn,
            { backgroundColor: colors.primary, opacity: pressed ? 0.85 : 1 },
          ]}
          onPress={handleSubmit}
          disabled={isPending}
        >
          {isPending ? (
            <ActivityIndicator color={colors.primaryForeground} size="small" />
          ) : (
            <>
              <Text style={[styles.submitText, { color: colors.primaryForeground }]}>
                Send Request
              </Text>
              <Feather name="send" size={16} color={colors.primaryForeground} />
            </>
          )}
        </Pressable>

        <Text style={[styles.disclaimer, { color: colors.mutedForeground }]}>
          We'll respond within 24 hours. No spam, ever.
        </Text>
      </KeyboardAwareScrollView>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1 },
  header: {
    paddingHorizontal: 20,
    paddingBottom: 16,
    borderBottomWidth: 1,
  },
  headerTitle: { fontSize: 28, fontFamily: 'Inter_700Bold', marginBottom: 2 },
  headerSubtitle: { fontSize: 14, fontFamily: 'Inter_400Regular' },
  formContent: { padding: 20, gap: 20 },
  formField: { gap: 8 },
  label: { fontSize: 13, fontFamily: 'Inter_600SemiBold' },
  input: {
    paddingHorizontal: 14,
    paddingVertical: 12,
    borderRadius: 8,
    borderWidth: 1,
    fontSize: 15,
    fontFamily: 'Inter_400Regular',
  },
  textArea: { height: 100, paddingTop: 12 },
  errorMsg: { fontSize: 12, fontFamily: 'Inter_400Regular', marginTop: -4 },
  row: { flexDirection: 'row', gap: 12 },
  halfField: { flex: 1 },
  chipRow: { flexDirection: 'row', gap: 8, paddingVertical: 2 },
  chip: {
    paddingHorizontal: 12,
    paddingVertical: 7,
    borderRadius: 20,
    borderWidth: 1,
  },
  chipText: { fontSize: 12, fontFamily: 'Inter_500Medium' },
  budgetGrid: { flexDirection: 'row', flexWrap: 'wrap', gap: 8 },
  budgetOption: {
    paddingHorizontal: 14,
    paddingVertical: 8,
    borderRadius: 8,
    borderWidth: 1,
  },
  budgetText: { fontSize: 13, fontFamily: 'Inter_500Medium' },
  submitBtn: {
    paddingVertical: 15,
    borderRadius: 10,
    alignItems: 'center',
    justifyContent: 'center',
    flexDirection: 'row',
    gap: 8,
    marginTop: 4,
  },
  submitText: { fontSize: 15, fontFamily: 'Inter_600SemiBold' },
  disclaimer: { fontSize: 12, fontFamily: 'Inter_400Regular', textAlign: 'center', marginTop: -8 },
  // Success state
  successContainer: { alignItems: 'center', justifyContent: 'center', padding: 40, gap: 16 },
  successIcon: {
    width: 88,
    height: 88,
    borderRadius: 44,
    alignItems: 'center',
    justifyContent: 'center',
    marginBottom: 8,
  },
  successTitle: { fontSize: 24, fontFamily: 'Inter_700Bold' },
  successSubtitle: {
    fontSize: 14,
    fontFamily: 'Inter_400Regular',
    textAlign: 'center',
    lineHeight: 21,
  },
});
